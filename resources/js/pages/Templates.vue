<template>
    <div class="template-page">
        <section class="template-hero mb-4">
            <div>
                <p class="section-label mb-2">Template Center</p>
                <h2 class="template-title mb-2">
                    Kelola template email dan surat lamaran PDF
                </h2>
                <p class="template-subtitle mb-0">
                    Siapkan email lamaran yang bisa diedit langsung dan pilih
                    surat lamaran PDF sebagai lampiran utama.
                </p>
            </div>
        </section>

        <section
            class="app-card template-workspace"
            style="transform: translateY(0px)"
        >
            <div class="template-toolbar">
                <ul
                    id="templateTabs"
                    class="nav nav-pills template-tabs"
                    role="tablist"
                >
                    <li class="nav-item" role="presentation">
                        <button
                            id="email-tab"
                            class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#email-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="email-tab-pane"
                            aria-selected="true"
                        >
                            <i class="bi bi-envelope-paper me-2"></i>
                            Template Email
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            id="letter-tab"
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#letter-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="letter-tab-pane"
                            aria-selected="false"
                        >
                            <i class="bi bi-filetype-pdf me-2"></i>
                            Surat Lamaran (PDF)
                        </button>
                    </li>
                </ul>
            </div>

            <div id="templateTabsContent" class="tab-content">
                <div
                    id="email-tab-pane"
                    class="tab-pane fade show active"
                    role="tabpanel"
                    aria-labelledby="email-tab"
                    tabindex="0"
                >
                    <div class="template-section-header">
                        <div>
                            <p class="section-label mb-1">Editable Template</p>
                            <h2 class="content-title mb-0">Template Email</h2>
                        </div>
                        <button
                            class="btn btn-primary app-primary-button"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#emailTemplateModal"
                            @click="openCreateModal"
                        >
                            <i class="bi bi-plus-lg me-2"></i>
                            Tambah Template
                        </button>
                    </div>

                    <div class="row g-4">
                        <div
                            v-for="template in emailTemplates"
                            :key="template.id"
                            class="col-12 col-lg-6 col-xxl-4"
                        >
                            <article class="template-card h-100">
                                <div class="template-card-header">
                                    <div class="template-icon email-icon">
                                        <i
                                            class="bi bi-envelope-heart-fill"
                                        ></i>
                                    </div>
                                    <span
                                        v-if="template.is_default"
                                        class="template-default-badge"
                                    >
                                        <i class="bi bi-star-fill"></i>
                                        Default
                                    </span>
                                </div>

                                <h3 class="template-card-title">
                                    {{ template.name }}
                                </h3>
                                <p class="template-date mb-3">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Update {{ formatDate(template.updated_at) }}
                                </p>
                                <p class="template-subject mb-2">
                                    {{ template.subject }}
                                </p>
                                <p class="template-preview mb-4">
                                    <!-- {{ template.preview }} -->
                                </p>

                                <div class="template-card-actions">
                                    <button
                                        class="btn btn-light btn-sm"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#emailTemplateModal"
                                        @click="openEditModal(template)"
                                    >
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Edit
                                    </button>
                                    <button
                                        class="btn btn-outline-danger btn-sm"
                                        type="button"
                                        @click="deleteTemplate(template)"
                                    >
                                        <i class="bi bi-trash3 me-1"></i>
                                        Delete
                                    </button>
                                    <button
                                        class="btn btn-outline-primary btn-sm"
                                        type="button"
                                        @click="setDefaultEmail(template)"
                                    >
                                        <i class="bi bi-star me-1"></i>
                                        Jadikan Default
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

                <div
                    id="letter-tab-pane"
                    class="tab-pane fade"
                    role="tabpanel"
                    aria-labelledby="letter-tab"
                    tabindex="0"
                >
                    <div class="template-section-header">
                        <div>
                            <p class="section-label mb-1">PDF Attachment</p>
                            <h2 class="content-title mb-0">
                                Surat Lamaran (PDF)
                            </h2>
                        </div>
                        <label class="btn btn-primary app-primary-button mb-0">
                            <i class="bi bi-cloud-upload me-2"></i>
                            Upload Surat Lamaran
                            <input
                                class="visually-hidden"
                                type="file"
                                accept="application/pdf"
                                @change="handleFileUpload"
                            />
                        </label>
                    </div>

                    <div class="template-pdf-note mb-4">
                        <i class="bi bi-info-circle-fill"></i>
                        <span
                            >Surat lamaran tidak diedit di website. Upload file
                            PDF untuk digunakan sebagai lampiran email.</span
                        >
                    </div>

                    <div class="row g-4">
                        <div
                            v-for="file in letterFiles"
                            :key="file.id"
                            class="col-12 col-lg-6 col-xxl-4"
                        >
                            <article
                                class="template-card pdf-template-card h-100"
                            >
                                <div class="template-card-header">
                                    <div class="template-icon pdf-icon">
                                        <i
                                            class="bi bi-file-earmark-pdf-fill"
                                        ></i>
                                    </div>
                                    <span
                                        v-if="file.isDefault"
                                        class="template-default-badge"
                                    >
                                        <i class="bi bi-star-fill"></i>
                                        Default
                                    </span>
                                </div>

                                <h3 class="template-card-title">
                                    {{ file.name }}
                                </h3>
                                <div class="pdf-file-meta mb-4">
                                    <span>
                                        <i class="bi bi-hdd me-1"></i>
                                        {{ file.size }}
                                    </span>
                                    <span>
                                        <i
                                            class="bi bi-calendar2-check me-1"
                                        ></i>
                                        {{ file.uploadedAt }}
                                    </span>
                                </div>

                                <div class="template-card-actions">
                                    <button
                                        class="btn btn-light btn-sm"
                                        type="button"
                                    >
                                        <i class="bi bi-download me-1"></i>
                                        Download
                                    </button>
                                    <button
                                        class="btn btn-outline-danger btn-sm"
                                        type="button"
                                    >
                                        <i class="bi bi-trash3 me-1"></i>
                                        Hapus
                                    </button>
                                    <button
                                        class="btn btn-outline-primary btn-sm"
                                        type="button"
                                    >
                                        <i class="bi bi-star me-1"></i>
                                        Jadikan Default
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div
            id="emailTemplateModal"
            class="modal fade"
            tabindex="-1"
            aria-labelledby="emailTemplateModalLabel"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
            >
                <div class="modal-content premium-modal">
                    <div class="modal-header">
                        <div>
                            <p class="section-label mb-1">Template Email</p>
                            <h2
                                id="emailTemplateModalLabel"
                                class="modal-title"
                            >
                                {{ modalTitle }}
                            </h2>
                        </div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-12 col-lg-6">
                                <label class="premium-label" for="templateName"
                                    >Nama Template</label
                                >
                                <div class="premium-field">
                                    <i class="bi bi-tag"></i>
                                    <input
                                        id="templateName"
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Contoh: Profesional Singkat"
                                    />
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label
                                    class="premium-label"
                                    for="templateSubject"
                                    >Subject Email</label
                                >
                                <div class="premium-field">
                                    <i class="bi bi-type"></i>
                                    <input
                                        id="templateSubject"
                                        v-model="form.subject"
                                        type="text"
                                        class="form-control"
                                        placeholder="Lamaran {{job_position}} - {{name}}"
                                    />
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="premium-label"
                                    for="templateContent"
                                    >Isi Email</label
                                >
                                <textarea
                                    id="templateContent"
                                    v-model="form.content"
                                    class="form-control template-modal-textarea"
                                    rows="12"
                                    placeholder="Yth. HR {{company_name}},

Saya {{name}} ingin melamar sebagai {{job_position}}.
Email saya {{email}}.

Dikirim pada {{today}}."
                                ></textarea>
                            </div>
                        </div>

                        <div class="placeholder-list mt-4">
                            <span
                                v-for="placeholder in placeholders"
                                :key="placeholder"
                                >{{ placeholder }}</span
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-light app-soft-button"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary app-primary-button"
                            data-bs-dismiss="modal"
                            @click="saveTemplateEmail"
                        >
                            <i class="bi bi-check2 me-2"></i>
                            Simpan Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, reactive, ref, onMounted } from "vue";

const placeholders = [
    "{{company_name}}",
    "{{job_position}}",
    "{{name}}",
    "{{email}}",
    "{{today}}",
];

const letterFiles = [
    {
        id: "letter-formal",
        name: "Surat_Lamaran_Formal.pdf",
        size: "840 KB",
        uploadedAt: "01 Jul 2026",
        isDefault: true,
    },
    {
        id: "letter-modern",
        name: "Cover_Letter_Modern.pdf",
        size: "1.1 MB",
        uploadedAt: "29 Jun 2026",
        isDefault: false,
    },
    {
        id: "letter-fresh",
        name: "Surat_Lamaran_Fresh_Graduate.pdf",
        size: "720 KB",
        uploadedAt: "25 Jun 2026",
        isDefault: false,
    },
];

//=================== Format Tanggal ===================//
const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
    });
};
//=================== Format Tanggal ===================//

import api from "../services/api.js";
import Swal from "sweetalert2";

//=================== Simpan Template Email ===================//

const modalMode = ref("create");
const form = reactive({
    id: null,
    name: "",
    subject: "",
    content: "",
});

const modalTitle = computed(() =>
    modalMode.value === "create" ? "Tambah Template" : "Edit Template",
);

const openCreateModal = () => {
    modalMode.value = "create";
    form.id = null;
    form.name = "";
    form.subject = "";
    form.content = "";
};

const openEditModal = (template) => {
    modalMode.value = "edit";
    form.id = template.id;
    form.name = template.name;
    form.subject = template.subject;
    form.content = template.content;
};

const saveTemplateEmail = async () => {
    try {
        if (modalMode.value === "create") {
            const response = await api.post("/templatesEmail", {
                name: form.name,
                subject: form.subject,
                content: form.content,
            });
            console.log("Template saved:", response.data);
            form.name = "";
            form.subject = "";
            form.content = "";
            Swal.fire({
                title: "Berhasil!",
                text: "Template berhasil disimpan",
                icon: "success",
            });
            await fetchTemplates();
            //Update template
        } else if (modalMode.value === "edit") {
            const response = await api.put(`/templatesEmail/${form.id}`, {
                name: form.name,
                subject: form.subject,
                content: form.content,
            });
            form.name = "";
            form.subject = "";
            form.content = "";
            Swal.fire({
                title: "Berhasil!",
                text: "Template berhasil diperbarui",
                icon: "success",
            });
            await fetchTemplates();
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Terjadi kesalahan saat menyimpan template. Silakan coba lagi.",
        });
    }
};

//=================== Simpan Template Email ===================//

//=================== Tampilkan Template Email ===================//

const emailTemplates = ref([]);

const fetchTemplates = async () => {
    try {
        const response = await api.get("/templatesEmail");
        emailTemplates.value = response.data.data;
    } catch (error) {
        console.error("Error fetching templates:", error);
    }
};

onMounted(() => {
    fetchTemplates();
});

//=================== Tampilkan Template Email ===================//

//=================== Set Default Email ===================//

const setDefaultEmail = async (template) => {
    try {
        await api.put(`/templatesEmail/${template.id}/set-default`);
        await fetchTemplates();
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Terjadi kesalahan saat menjadikan template default.",
        });
    }
};
//=================== Set Default Email ===================//

//=================== Delete Email Template ===================//
const deleteTemplate = async (template) => {
    try {
        await api.delete(`/templatesEmail/${template.id}`);
        await fetchTemplates();
        Swal.fire({
            title: "Berhasil!",
            text: "Template berhasil dihapus",
            icon: "success",
        });
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Terjadi kesalahan saat menghapus template. Silakan coba lagi.",
        });
    }
};
//=================== Delete Email Template ===================//

//=================== Simpan Surat Lamaran Template ===================//

const letterForm = ref(null);

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file && file.type === "application/pdf") {
        letterForm.value = file;
    } else {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Harap unggah file PDF.",
        });
    }
    saveCoverLetter();
};

const saveCoverLetter = async () => {
    try {
        if (letterForm.value) {
            const response = await api.post(
                "/templatesCoverLetter",
                {
                    file: letterForm.value,
                },
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                },
            );

            Swal.fire({
                title: "Berhasil!",
                text: "Surat lamaran berhasil diunggah.",
                icon: "success",
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Harap pilih file PDF untuk diunggah.",
            });
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Terjadi kesalahan saat mengunggah surat lamaran. Silakan coba lagi.",
        });
    }
};
//=================== Simpan Surat Lamaran Template ===================//
</script>
