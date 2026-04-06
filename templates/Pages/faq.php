<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContentBlock[]|null $blocks
 */
$identity = $this->request->getAttribute('identity');
$isAdmin = $identity && $identity->role;

$blocksArr = [];
if (!empty($blocks) && method_exists($blocks, 'toArray')) {
    $blocksArr = $blocks->toArray();
} elseif (is_array($blocks)) {
    $blocksArr = $blocks;
}
?>
<?php
$this->start('css');
?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<?php
$this->end();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-3/assets/css/faq-3.css">

<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top:100px;">
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>FAQ</h2>
                    <p>Frequently Asked Questions</p>
                    <div class="border"></div>
                    <?php if ($isAdmin): ?>
                        <button id="faq-edit-toggle" class="btn btn-sm btn-outline-primary mt-3">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>
                        <button id="faq-save-all" class="btn btn-sm btn-success mt-3 ms-2 d-none">
                            <i class="bi bi-save me-1"></i>Save All
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div id="faq-static">
            <?php
            $headers = array_filter($blocksArr, fn($b) => $b->parent_id===null && $b->label==='Header');
            foreach ($headers as $hdr):
                $icon = 'bi bi-question';
                foreach ($blocksArr as $cb) {
                    if ($cb->parent_id=== $hdr->id && $cb->label==='Icon') {
                        $icon = h($cb->value);
                        break;
                    }
                }
                ?>
                <div class="mb-8">
                    <div class="row justify-content-center">
                        <div class="col-11 col-xl-10">
                            <div class="d-flex align-items-end mb-5">
                                <i class="<?= $icon ?> me-3 lh-1 display-6"></i>
                                <h4 class="m-0"><?= h($hdr->value) ?></h4>
                            </div>
                        </div>
                        <div class="col-11 col-xl-10">
                            <div class="accordion accordion-flush" id="faqGroup<?= $hdr->id ?>">
                                <?php
                                foreach ($blocksArr as $q) {
                                    if ($q->parent_id=== $hdr->id && $q->label==='Question') {
                                        $ansText = '';
                                        foreach ($blocksArr as $a) {
                                            if ($a->parent_id=== $q->id && $a->label==='Answer') {
                                                $ansText = h($a->value);
                                                break;
                                            }
                                        }
                                        ?>
                                        <div class="accordion-item bg-transparent border-bottom py-3">
                                            <h2 class="accordion-header" id="faqHeading<?= $q->id ?>">
                                                <button class="accordion-button collapsed bg-transparent fw-bold shadow-none"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#faqCollapse<?= $q->id ?>"
                                                        aria-expanded="false"
                                                        aria-controls="faqCollapse<?= $q->id ?>">
                                                    <?= h($q->value) ?>
                                                </button>
                                            </h2>
                                            <div id="faqCollapse<?= $q->id ?>" class="accordion-collapse collapse" aria-labelledby="faqHeading<?= $q->id ?>">
                                                <div class="accordion-body">
                                                    <p><?= $ansText ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($isAdmin): ?>
            <div id="faq-editor" class="d-none"></div>
        <?php endif; ?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const BASE = <?= json_encode($this->request->getAttribute('base')) ?>;
    const CSRF = <?= json_encode($this->request->getAttribute('csrfToken')) ?>;
    $.ajaxSetup({ headers:{ 'X-CSRF-Token': CSRF } });

    function ajaxPost(url, data = {}) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': CSRF,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
                if (res.status === 404 && url.includes('/delete/')) {
                    return {};
                }
                throw new Error(`Status ${res.status}`);
            });
    }


    $(function() {
        <?php if ($isAdmin): ?>
        let editing = false;
        const INDEX_URL = `${BASE}/content-blocks/index.json?page=faq`;

        // track deletes
        const deletedSections  = [];
        const deletedIcons     = [];
        const deletedQuestions = [];
        const deletedAnswers   = [];

        $('#faq-edit-toggle').click(function() {
            editing = !editing;
            $('#faq-save-all').toggleClass('d-none', !editing);
            if (editing) {
                $('#faq-static').hide();
                $(this).html('<i class="bi bi-x-circle me-1"></i>Close');
                $('#faq-editor')
                    .removeClass('d-none')
                    .html('<div class="text-center py-4">Loading editor…</div>');
                // clear previous
                deletedSections.length = 0;
                deletedIcons.length = 0;
                deletedQuestions.length = 0;
                deletedAnswers.length = 0;
                loadEditor();
            } else {
                $('#faq-editor').addClass('d-none').empty();
                $(this).html('<i class="bi bi-pencil-square me-1"></i>Edit');
                $('#faq-static').show();
            }
        });

        $('#faq-save-all').off('click').on('click', function() {
            const $btn = $(this).prop('disabled', true).html('<i class="bi bi-save me-1"></i>Saving…');
            const deleteOps = [];
            deletedSections.forEach(id  => deleteOps.push(ajaxPost(`${BASE}/content-blocks/delete/${id}.json`)));
            deletedIcons.forEach(id  => deleteOps.push(ajaxPost(`${BASE}/content-blocks/delete/${id}.json`)));
            deletedQuestions.forEach(id => deleteOps.push(ajaxPost(`${BASE}/content-blocks/delete/${id}.json`)));
            deletedAnswers.forEach(id => deleteOps.push(ajaxPost(`${BASE}/content-blocks/delete/${id}.json`)));

            const saveChains = [];
            $('#faq-editor .faq-card').filter((i,el) => $(el).find('.header-input').length > 0).each(function() {
                const $c   = $(this);
                const hdrId = $c.find('.header-input').data('block-id');
                const hdrTxt= $c.find('.header-input').val().trim();

                // Header promise
                let hdrPromise;
                if (!hdrTxt && hdrId) {
                    // deleting an existing header
                    hdrPromise = ajaxPost(`${BASE}/content-blocks/delete/${hdrId}.json`).then(() => null);
                } else if (hdrTxt) {
                    // add or edit
                    if (hdrId) {
                        hdrPromise = ajaxPost(`${BASE}/content-blocks/edit/${hdrId}.json`, { value: hdrTxt })
                            .then(res => res.block.id);
                    } else {
                        hdrPromise = ajaxPost(`${BASE}/content-blocks/add.json`, {
                            page: 'faq', parent_id: null, label: 'Header', value: hdrTxt
                        }).then(res => res.block.id);
                    }
                } else {
                    // empty new header: nothing to do
                    hdrPromise = Promise.resolve(null);
                }

                // chain icon --> QA off header promise
                const chain = hdrPromise.then(realHdrId => {
                    if (!realHdrId) return;

                    // Icon
                    const icId  = $c.find('.icon-select').data('block-id');
                    const icVal = $c.find('.icon-select').val();
                    let icPromise;
                    if (!icVal && icId) {
                        icPromise = ajaxPost(`${BASE}/content-blocks/delete/${icId}.json`);
                    } else if (icVal) {
                        if (icId) {
                            icPromise = ajaxPost(`${BASE}/content-blocks/edit/${icId}.json`, { value: icVal });
                        } else {
                            icPromise = ajaxPost(`${BASE}/content-blocks/add.json`, {
                                page: 'faq', parent_id: realHdrId, label: 'Icon', value: icVal
                            });
                        }
                    } else {
                        icPromise = Promise.resolve();
                    }

                    // Q/A pairs (after icon)
                    return icPromise.then(() => {
                        const qaOps = [];
                        $c.find('.qa-pair').each(function() {
                            const $pair = $(this);
                            const qId = $pair.find('.question-input').data('block-id');
                            const qTxt = $pair.find('.question-input').val().trim();
                            const aId = $pair.find('.answer-input').data('block-id');
                            const aTxt = $pair.find('.answer-input').val().trim();

                            // question
                            if (!qTxt && qId) {
                                qaOps.push(ajaxPost(`${BASE}/content-blocks/delete/${qId}.json`));
                                if (aId) qaOps.push(ajaxPost(`${BASE}/content-blocks/delete/${aId}.json`));
                            } else if (qTxt) {
                                let qOp = qId
                                    ? ajaxPost(`${BASE}/content-blocks/edit/${qId}.json`, { value: qTxt })
                                        .then(res => res.block.id)
                                    : ajaxPost(`${BASE}/content-blocks/add.json`, {
                                        page: 'faq', parent_id: realHdrId, label: 'Question', value: qTxt
                                    }).then(res => res.block.id);
                                // chain answer onto question
                                qOp = qOp.then(realQId => {
                                    if (!realQId) return;
                                    if (!aTxt && aId) {
                                        return ajaxPost(`${BASE}/content-blocks/delete/${aId}.json`);
                                    } else if (aTxt) {
                                        if (aId) {
                                            return ajaxPost(`${BASE}/content-blocks/edit/${aId}.json`, { value: aTxt });
                                        } else {
                                            return ajaxPost(`${BASE}/content-blocks/add.json`, {
                                                page: 'faq', parent_id: realQId, label: 'Answer', value: aTxt
                                            });
                                        }
                                    }
                                });
                                qaOps.push(qOp);
                            }
                        });

                        return Promise.all(qaOps);
                    });
                });

                saveChains.push(chain);
            });

            Promise.all([ ...deleteOps, ...saveChains ])
                .then(() => window.location.reload(true))
                .catch(() => {
                    $btn.prop('disabled', false).html('<i class="bi bi-save me-1"></i>Save All');
                    $('#faq-save-all').after(
                        '<div class="alert alert-danger mt-2">Error saving FAQ. Please try again.</div>'
                    );
                });
        });

        function loadEditor() {
            console.log('Loading FAQ editor from', INDEX_URL);
            fetch(INDEX_URL, {
                headers: {
                    'X-CSRF-Token': CSRF,
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => renderEditor(data.blocks))
                .catch(err => {
                    console.error('Error loading editor:', err);
                    $('#faq-editor').html(
                        '<div class="alert alert-danger">Error loading editor</div>'
                    );
                });
        }

        function renderEditor(blocks) {
            const $ct = $('#faq-editor').empty();
            blocks.filter(b => b.label==='Header')
                .forEach(h => createCard($ct, h, blocks));
            createAddCard($ct);
        }

        function createCard(parent, hdr, blocks) {
            const icon = blocks.find(b=>b.parent_id==hdr.id && b.label==='Icon')||{};
            const qs   = blocks.filter(b=>b.parent_id==hdr.id && b.label==='Question');
            const $card = $(`
      <div class="card faq-card mb-4 mx-auto" style="width:80%;">
        <div class="card-body position-relative">
          <div class="mb-3 d-flex align-items-center">
            <select class="form-select me-2 icon-select" style="width:auto;"></select>
            <input type="text" class="form-control header-input" placeholder="Header"/>
          </div>
          <div class="questions-list"></div>
          <div class="mt-3 text-end">
            <button class="btn btn-sm btn-outline-secondary add-question me-2">+</button>
            <button class="btn btn-danger delete-section"><i class="bi bi-trash me-1"></i>Delete</button>
          </div>
        </div>
      </div>`
            );

            // populate icons
            [['bi bi-question','?'],['bi bi-cart-plus','🛒'],['bi bi-bag-dash','🛍️']]
                .forEach(([val,label])=>
                    $card.find('.icon-select').append(`<option value="${val}">${label}</option>`)
                );

            $card.find('.icon-select')
                .val(icon.value||'bi bi-question')
                .data('block-id', icon.id||null);

            $card.find('.header-input')
                .val(hdr.value)
                .data('block-id', hdr.id);

            const $ql = $card.find('.questions-list');
            qs.forEach(q=>{
                const a = blocks.find(b=>b.parent_id==q.id && b.label==='Answer')||{};
                addQA($ql, q, a);
            });

            parent.append($card);
            bindCardEvents($card);
        }

        function addQA($list, q, a) {
            const $pair = $('<div class="qa-pair mb-3"></div>');
            const $row  = $(`
      <div class="input-group mb-2">
        <input type="text" class="form-control question-input" placeholder="Question"/>
        <button class="btn btn-outline-secondary delete-field" type="button"><i class="bi bi-x-lg"></i></button>
      </div>`);
            const $ans  = $(`<textarea class="form-control answer-input mb-2" rows="2" placeholder="Answer"></textarea>`);

            $row.find('.question-input').val(q.value||'').data('block-id', q.id);
            $ans.val(a.value||'').data('block-id', a.id);

            // delete QA pair
            $row.find('.delete-field').click(() => {
                const qid = $row.find('.question-input').data('block-id');
                const aid = $ans.data('block-id');
                if (qid) deletedQuestions.push(qid);
                if (aid) deletedAnswers.push(aid);
                $pair.remove();
            });

            $pair.append($row).append($ans);
            $list.append($pair);
        }

        function bindCardEvents(card) {
            // add QA
            card.find('.add-question').click(()=>{
                addQA(card.find('.questions-list'), {id:null,value:''}, {id:null,value:''});
            });
            // delete section + its icon
            card.find('.delete-section').click(function(){
                const hid = card.find('.header-input').data('block-id');
                const icid= card.find('.icon-select').data('block-id');
                if (hid)  deletedSections.push(hid);
                if (icid) deletedIcons.push(icid);
                card.remove();
            });
        }

        function createAddCard($ct) {
            const $add = $(`
      <div class="card faq-card mb-4 mx-auto" style="width:80%;opacity:0.6;">
        <div class="card-body d-flex justify-content-center align-items-center" style="height:150px;">
          <button class="btn btn-outline-primary add-section"><i class="bi bi-plus-lg"></i></button>
        </div>
      </div>`);
            $ct.append($add);
            $add.find('.add-section').click(()=>{
                $add.remove();
                createCard($ct, {id:null,value:''}, []);
                createAddCard($ct);
            });
        }
        <?php endif; ?>
    });
    $(document).ajaxStop(function(){
        if ($('#faq-save-all').prop('disabled')) {
            window.location.reload(true);
        }
    });
</script>
