<template>
    <div class="apply-page">
        <section class="apply-hero mb-4">
            <div>
                <p class="section-label mb-2">Auto Apply</p>
                <h2 class="apply-title mb-2">Buat lamaran pekerjaan baru</h2>
                <p class="apply-subtitle mb-0">
                    Lengkapi informasi perusahaan, pilih template, lalu sertakan lampiran terbaik sebelum email dikirim.
                </p>
            </div>
            <div class="apply-hero-badge">
                <i class="bi bi-stars"></i>
                <span>Premium Flow</span>
            </div>
        </section>

        <div class="row g-4">
            <div class="col-12 col-xl-8">
                <section class="app-card apply-form-card h-100">
                    <div class="card-heading">
                        <div>
                            <p class="section-label mb-1">Informasi Lamaran</p>
                            <h2 class="content-title mb-0">Detail perusahaan dan email</h2>
                        </div>
                        <span class="form-step-pill">
                            <i class="bi bi-pencil-square"></i>
                            Step 1
                        </span>
                    </div>

                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label class="premium-label" for="companyName">Nama Perusahaan</label>
                            <div class="premium-field">
                                <i class="bi bi-building"></i>
                                <input
                                    id="companyName"
                                    v-model="form.company"
                                    type="text"
                                    class="form-control"
                                    placeholder="Contoh: Mediatama Digital"
                                />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="premium-label" for="jobPosition">Posisi</label>
                            <div class="premium-field">
                                <i class="bi bi-briefcase"></i>
                                <input
                                    id="jobPosition"
                                    v-model="form.position"
                                    type="text"
                                    class="form-control"
                                    placeholder="Contoh: Frontend Developer"
                                />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="premium-label" for="hrEmail">Email HR</label>
                            <div class="premium-field">
                                <i class="bi bi-envelope"></i>
                                <input
                                    id="hrEmail"
                                    v-model="form.email"
                                    type="email"
                                    class="form-control"
                                    placeholder="hr@company.com"
                                />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="premium-label" for="emailSubject">Subjek</label>
                            <div class="premium-field">
                                <i class="bi bi-type"></i>
                                <input
                                    id="emailSubject"
                                    v-model="form.subject"
                                    type="text"
                                    class="form-control"
                                    placeholder="Lamaran - Frontend Developer"
                                />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="premium-label">Template Email</label>
                            <div class="dropdown premium-dropdown">
                                <button
                                    class="btn dropdown-toggle premium-dropdown-button"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-chat-left-text"></i>
                                    <span>{{ form.emailTemplate }}</span>
                                </button>
                                <ul class="dropdown-menu premium-dropdown-menu">
                                    <li v-for="template in emailTemplates" :key="template">
                                        <button class="dropdown-item" type="button" @click="form.emailTemplate = template">
                                            {{ template }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="premium-label">Template Surat</label>
                            <div class="dropdown premium-dropdown">
                                <button
                                    class="btn dropdown-toggle premium-dropdown-button"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <i class="bi bi-file-earmark-richtext"></i>
                                    <span>{{ form.letterTemplate }}</span>
                                </button>
                                <ul class="dropdown-menu premium-dropdown-menu">
                                    <li v-for="template in letterTemplates" :key="template">
                                        <button class="dropdown-item" type="button" @click="form.letterTemplate = template">
                                            {{ template }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-12 col-xl-4">
                <section class="app-card attachment-card h-100">
                    <div class="card-heading">
                        <div>
                            <p class="section-label mb-1">Lampiran</p>
                            <h2 class="content-title mb-0">Dokumen pendukung</h2>
                        </div>
                        <span class="form-step-pill">
                            <i class="bi bi-paperclip"></i>
                            Step 2
                        </span>
                    </div>

                    <div class="attachment-list">
                        <label
                            v-for="attachment in attachments"
                            :key="attachment.id"
                            class="attachment-item"
                            :class="{ active: attachment.selected }"
                        >
                            <input v-model="attachment.selected" class="form-check-input" type="checkbox" />
                            <span class="attachment-icon" :class="attachment.variant">
                                <i :class="attachment.icon"></i>
                            </span>
                            <span class="attachment-copy">
                                <span class="attachment-title">{{ attachment.label }}</span>
                                <span class="attachment-file">{{ attachment.file }}</span>
                            </span>
                            <i class="bi bi-check-circle-fill attachment-check"></i>
                        </label>
                    </div>
                </section>
            </div>
        </div>

        <section class="apply-action-bar mt-4">
            <div>
                <p class="mb-1 apply-action-title">Siap mengirim lamaran?</p>
                <span>{{ selectedAttachments.length }} lampiran dipilih untuk email ini.</span>
            </div>
            <div class="apply-action-buttons">
                <button class="btn btn-light app-soft-button" type="button" data-bs-toggle="modal" data-bs-target="#previewModal">
                    <i class="bi bi-eye me-2"></i>
                    Preview
                </button>
                <button class="btn btn-primary app-primary-button" type="button">
                    <i class="bi bi-send-fill me-2"></i>
                    Kirim Email
                </button>
            </div>
        </section>

        <div id="previewModal" class="modal fade" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content premium-modal">
                    <div class="modal-header">
                        <div>
                            <p class="section-label mb-1">Preview</p>
                            <h2 id="previewModalLabel" class="modal-title">Email Lamaran</h2>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="preview-email">
                            <div class="preview-row">
                                <span>Kepada</span>
                                <strong>{{ form.email || "hr@company.com" }}</strong>
                            </div>
                            <div class="preview-row">
                                <span>Subjek</span>
                                <strong>{{ form.subject || "Lamaran Pekerjaan" }}</strong>
                            </div>
                            <div class="preview-message">
                                <p>Yth. Tim HR {{ form.company || "Perusahaan" }},</p>
                                <p>
                                    Saya ingin mengajukan lamaran untuk posisi
                                    <strong>{{ form.position || "Posisi yang dilamar" }}</strong>.
                                    Email ini menggunakan {{ form.emailTemplate }} dan dilengkapi dengan
                                    {{ form.letterTemplate }}.
                                </p>
                                <p>
                                    Bersama email ini saya lampirkan dokumen pendukung untuk pertimbangan lebih lanjut.
                                </p>
                            </div>
                            <div class="preview-attachments">
                                <span v-for="attachment in selectedAttachments" :key="attachment.id" class="preview-chip">
                                    <i :class="attachment.icon"></i>
                                    {{ attachment.label }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light app-soft-button" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary app-primary-button">
                            <i class="bi bi-send-fill me-2"></i>
                            Kirim Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, reactive } from "vue";

const form = reactive({
    company: "Mediatama Digital",
    position: "Frontend Developer",
    email: "hr@mediatama.test",
    subject: "Lamaran Frontend Developer - Ari Recruiter",
    emailTemplate: "Profesional Singkat",
    letterTemplate: "Surat Lamaran Formal",
});

const emailTemplates = ["Profesional Singkat", "Friendly Recruiter", "Follow Up Lamaran"];
const letterTemplates = ["Surat Lamaran Formal", "Cover Letter Modern", "Fresh Graduate"];

const attachments = reactive([
    {
        id: "cv",
        label: "CV",
        file: "CV_Ari_Recruiter.pdf",
        icon: "bi bi-file-person-fill",
        variant: "attachment-primary",
        selected: true,
    },
    {
        id: "portfolio",
        label: "Portfolio",
        file: "portfolio-frontend.pdf",
        icon: "bi bi-kanban-fill",
        variant: "attachment-success",
        selected: true,
    },
    {
        id: "certificate",
        label: "Sertifikat",
        file: "sertifikat-vue-laravel.pdf",
        icon: "bi bi-award-fill",
        variant: "attachment-warning",
        selected: false,
    },
    {
        id: "transcript",
        label: "Transkrip",
        file: "transkrip-akademik.pdf",
        icon: "bi bi-mortarboard-fill",
        variant: "attachment-danger",
        selected: false,
    },
]);

const selectedAttachments = computed(() => attachments.filter((attachment) => attachment.selected));
</script>
