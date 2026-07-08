<template>
    <div class="attachments-page attachments-fade-in">
        <section class="attachment-hero mb-4">
            <div>
                <p class="section-label mb-2">Lampiran</p>
                <h2 class="attachment-page-title mb-2">Lampiran</h2>
                <p class="attachment-page-subtitle mb-0">
                    Kelola seluruh file yang akan digunakan sebagai lampiran
                    saat mengirim lamaran pekerjaan.
                </p>
            </div>
            <button
                class="btn btn-primary app-primary-button"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#uploadAttachmentModal"
            >
                <i class="bi bi-cloud-upload me-2"></i>
                Upload Lampiran
            </button>
        </section>

        <section class="app-card attachment-manager-card">
            <div class="attachment-manager-top">
                <div>
                    <p class="section-label mb-1">File Library</p>
                    <h2 class="content-title mb-0">Daftar Lampiran</h2>
                </div>

                <div class="attachment-filter-bar">
                    <div class="attachment-search-input">
                        <i class="bi bi-search"></i>
                        <input
                            v-model="searchKeyword"
                            type="search"
                            class="form-control attachment-control"
                            placeholder="Cari nama file..."
                        />
                    </div>

                    <select
                        v-model="selectedType"
                        class="form-select attachment-control attachment-type-filter"
                    >
                        <option
                            v-for="type in filterTypes"
                            :key="type"
                            :value="type"
                        >
                            {{ type }}
                        </option>
                    </select>
                </div>
            </div>

            <div v-if="isLoading" class="attachment-skeleton-list">
                <div
                    v-for="item in 5"
                    :key="item"
                    class="attachment-skeleton-row"
                >
                    <span class="skeleton-block skeleton-avatar"></span>
                    <span class="skeleton-block skeleton-name"></span>
                    <span class="skeleton-block skeleton-badge"></span>
                    <span class="skeleton-block skeleton-small"></span>
                    <span class="skeleton-block skeleton-actions"></span>
                </div>
            </div>

            <div
                v-else-if="filteredAttachments.length === 0"
                class="attachment-empty-state"
            >
                <div class="attachment-empty-icon">
                    <i class="bi bi-folder-x"></i>
                </div>
                <h3>Belum ada lampiran</h3>
                <p>
                    Upload file pertama atau ubah filter pencarian untuk melihat
                    data lampiran.
                </p>
            </div>

            <template v-else>
                <div class="table-responsive">
                    <table
                        class="table align-middle mb-0 app-table attachment-table"
                    >
                        <thead>
                            <tr>
                                <th>Nama File</th>
                                <th>Jenis Lampiran</th>
                                <th>Ukuran</th>
                                <th>Tanggal Upload</th>
                                <th>Status Default</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="attachment in filteredAttachments"
                                :key="attachment.id"
                            >
                                <td>
                                    <div class="attachment-file-cell">
                                        <span class="attachment-file-icon">
                                            <i :class="attachment.icon"></i>
                                        </span>
                                        <span>{{ attachment.name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge attachment-type-badge"
                                        :class="typeClass(attachment.type)"
                                    >
                                        {{ attachment.type }}
                                    </span>
                                </td>
                                <td>{{ attachment.size }}</td>
                                <td>{{ attachment.uploadedAt }}</td>
                                <td>
                                    <span
                                        v-if="attachment.isDefault"
                                        class="badge attachment-default-badge"
                                        >Default</span
                                    >
                                    <span
                                        v-else
                                        class="attachment-empty-default"
                                        >-</span
                                    >
                                </td>
                                <td>
                                    <div class="attachment-row-actions">
                                        <button
                                            class="btn btn-light btn-sm"
                                            type="button"
                                        >
                                            <i class="bi bi-download me-1"></i>
                                            Download
                                        </button>
                                        <button
                                            class="btn btn-outline-primary btn-sm"
                                            type="button"
                                        >
                                            <i class="bi bi-star me-1"></i>
                                            Jadikan Default
                                        </button>
                                        <button
                                            class="btn btn-outline-danger btn-sm"
                                            type="button"
                                        >
                                            <i class="bi bi-trash3 me-1"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <nav
                    class="attachment-pagination mt-4"
                    aria-label="Pagination lampiran"
                >
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <button class="page-link" type="button">
                                Previous
                            </button>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <button class="page-link" type="button">1</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" type="button">2</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" type="button">3</button>
                        </li>
                        <li class="page-item">
                            <button class="page-link" type="button">
                                Next
                            </button>
                        </li>
                    </ul>
                </nav>
            </template>
        </section>

        <Teleport to="body">
            <div
                id="uploadAttachmentModal"
                class="modal fade attachment-upload-modal"
                tabindex="-1"
                aria-labelledby="uploadAttachmentModalLabel"
                aria-hidden="true"
            >
                <div
                    class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
                >
                    <div class="modal-content premium-modal">
                        <div class="modal-header">
                            <div>
                                <p class="section-label mb-1">
                                    Upload Lampiran
                                </p>
                                <h2
                                    id="uploadAttachmentModalLabel"
                                    class="modal-title"
                                >
                                    Tambah Lampiran Baru
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
                                    <label
                                        class="premium-label"
                                        for="attachmentName"
                                        >Nama File</label
                                    >
                                    <div class="premium-field">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <input
                                            id="attachmentName"
                                            v-model="formDataAttachment.name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Contoh: CV ATS 2026"
                                        />
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label
                                        class="premium-label"
                                        for="attachmentType"
                                        >Jenis Lampiran</label
                                    >
                                    <select
                                        id="attachmentType"
                                        class="form-select attachment-modal-select"
                                        v-model="formDataAttachment.type"
                                    >
                                        <option
                                            v-for="type in uploadTypes"
                                            :key="type"
                                            :value="type"
                                        >
                                            {{ type }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label
                                        class="premium-label"
                                        for="attachmentFile"
                                        >Upload File</label
                                    >
                                    <label
                                        class="attachment-modal-upload"
                                        :class="{
                                            'is-file-ready':
                                                selectedAttachmentFile,
                                        }"
                                        for="attachmentFile"
                                    >
                                        <template v-if="selectedAttachmentFile">
                                            <span class="attachment-ready-icon">
                                                <i
                                                    class="bi bi-check-circle-fill"
                                                ></i>
                                            </span>
                                            <span class="attachment-ready-copy">
                                                <strong>{{
                                                    selectedAttachmentFile.name
                                                }}</strong>
                                                <small>
                                                    {{
                                                        formatFileSize(
                                                            selectedAttachmentFile.size,
                                                        )
                                                    }}
                                                    - siap diupload
                                                </small>
                                            </span>
                                        </template>
                                        <template v-else>
                                            <i
                                                class="bi bi-cloud-arrow-up-fill"
                                            ></i>
                                            <span
                                                >Pilih atau drag file ke area
                                                ini</span
                                            >
                                            <small
                                                >PDF, DOCX, ZIP, JPG, PNG</small
                                            >
                                        </template>
                                        <small
                                            v-if="selectedAttachmentFile"
                                            class="attachment-ready-hint"
                                            >Klik Upload untuk menyimpan file
                                            ini</small
                                        >
                                    </label>
                                    <input
                                        id="attachmentFile"
                                        class="visually-hidden"
                                        type="file"
                                        @change="handleFileLampiran"
                                    />
                                </div>

                                <div class="col-12">
                                    <label class="attachment-default-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            v-model="
                                                formDataAttachment.isDefault
                                            "
                                        />
                                        <span>Jadikan sebagai default</span>
                                    </label>
                                </div>
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
                                @click="saveAttachment"
                                data-bs-dismiss="modal"
                            >
                                <i class="bi bi-cloud-upload me-2"></i>
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";

const searchKeyword = ref("");
const selectedType = ref("Semua");
const isLoading = ref(false);

const filterTypes = [
    "Semua",
    "CV",
    "Surat Lamaran",
    "Portfolio",
    "Sertifikat",
    "Transkrip",
    "Other",
];
const uploadTypes = ["CV", "Portfolio", "Certificate", "Transcript", "Other"];

const attachments = [
    {
        id: 1,
        name: "CV_Ari_Recruiter_2026.pdf",
        type: "CV",
        size: "1.8 MB",
        uploadedAt: "01 Jul 2026",
        isDefault: true,
        icon: "bi bi-file-person-fill",
    },
    {
        id: 2,
        name: "Surat_Lamaran_Formal.pdf",
        type: "Surat Lamaran",
        size: "840 KB",
        uploadedAt: "01 Jul 2026",
        isDefault: true,
        icon: "bi bi-file-earmark-pdf-fill",
    },
    {
        id: 3,
        name: "Portfolio_Frontend.pdf",
        type: "Portfolio",
        size: "4.6 MB",
        uploadedAt: "30 Jun 2026",
        isDefault: true,
        icon: "bi bi-kanban-fill",
    },
    {
        id: 4,
        name: "Sertifikat_Vue_Laravel.pdf",
        type: "Sertifikat",
        size: "980 KB",
        uploadedAt: "25 Jun 2026",
        isDefault: false,
        icon: "bi bi-award-fill",
    },
    {
        id: 5,
        name: "Transkrip_Akademik.pdf",
        type: "Transkrip",
        size: "1.1 MB",
        uploadedAt: "20 Jun 2026",
        isDefault: false,
        icon: "bi bi-mortarboard-fill",
    },
    {
        id: 6,
        name: "Referensi_Project.zip",
        type: "Other",
        size: "6.2 MB",
        uploadedAt: "18 Jun 2026",
        isDefault: false,
        icon: "bi bi-file-zip-fill",
    },
];

const typeClassMap = {
    CV: "type-cv",
    "Surat Lamaran": "type-letter",
    Portfolio: "type-portfolio",
    Sertifikat: "type-certificate",
    Transkrip: "type-transcript",
    Other: "type-other",
};

const filteredAttachments = computed(() => {
    const keyword = searchKeyword.value.toLowerCase().trim();

    return attachments.filter((attachment) => {
        const matchesKeyword =
            !keyword || attachment.name.toLowerCase().includes(keyword);
        const matchesType =
            selectedType.value === "Semua" ||
            attachment.type === selectedType.value;

        return matchesKeyword && matchesType;
    });
});

const typeClass = (type) => typeClassMap[type] || "type-other";

import Swal from "sweetalert2";
import api from "../services/api.js";

//==========================Simpan Lampiran==========================

const formDataAttachment = ref({
    name: "",
    type: "",
    file: null,
    isDefault: false,
});

const handleFileLampiran = (event) => {
    const file = event.target.files[0];
    formDataAttachment.value.file = file;
};

const selectedAttachmentFile = computed(() => formDataAttachment.value.file);

const formatFileSize = (size) => {
    if (!size) {
        return "0 B";
    }

    if (size < 1024) {
        return `${size} B`;
    }

    if (size < 1024 * 1024) {
        return `${(size / 1024).toFixed(1)} KB`;
    }

    return `${(size / (1024 * 1024)).toFixed(1)} MB`;
};

const saveAttachment = async () => {
    try {
        const formData = new FormData();
        formData.append("name", formDataAttachment.value.name);
        formData.append("type", formDataAttachment.value.type);
        formData.append("file", formDataAttachment.value.file);
        formData.append("isDefault", formDataAttachment.value.isDefault);
        const response = await api.post("/attachments", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        formDataAttachment.value.name = "";
        formDataAttachment.value.type = "";
        formDataAttachment.value.file = null;
        formDataAttachment.value.isDefault = false;
        Swal.fire({
            title: "Berhasil!",
            text: "Lampiran berhasil diunggah",
            icon: "success",
        });
    } catch (error) {
        console.error("Error uploading attachment:", error);
        Swal.fire({
            title: "Gagal!",
            text: "Terjadi kesalahan saat mengunggah lampiran",
            icon: "error",
        });
    }
};

//==========================Simpan Lampiran==========================
</script>
