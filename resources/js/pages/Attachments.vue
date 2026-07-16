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
                v-else-if="attachments.length === 0"
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
                                v-for="attachment in attachments"
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
                                            @click="
                                                downloadAttachment(attachment)
                                            "
                                        >
                                            <i class="bi bi-download me-1"></i>
                                            Download
                                        </button>
                                        <button
                                            v-if="!attachment.isDefault"
                                            class="btn btn-outline-primary btn-sm"
                                            type="button"
                                            @click="
                                                setDefaultAttachment(
                                                    attachment.id,
                                                )
                                            "
                                        >
                                            <i class="bi bi-star me-1"></i>
                                            Jadikan Default
                                        </button>
                                        <button
                                            v-else
                                            class="btn btn-outline-primary btn-sm"
                                            type="button"
                                            @click="
                                                removeDefaultAttachment(
                                                    attachment.id,
                                                )
                                            "
                                        >
                                            <i class="bi bi-star me-1"></i>
                                            Hapus Default
                                        </button>
                                        <button
                                            class="btn btn-outline-danger btn-sm"
                                            type="button"
                                            @click="
                                                deleteAttachment(attachment.id)
                                            "
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
                        <li
                            class="page-item"
                            :class="{ disabled: !pagination.prev_page_url }"
                        >
                            <button
                                class="page-link"
                                type="button"
                                @click="
                                    fetchAttachments(
                                        pagination.current_page - 1,
                                    )
                                "
                                :disabled="!pagination.prev_page_url"
                            >
                                Previous
                            </button>
                        </li>
                        <li
                            class="page-item"
                            aria-current="page"
                            v-for="page in pagination.last_page"
                            :key="page"
                            :class="{
                                active: page === pagination.current_page,
                            }"
                        >
                            <button
                                class="page-link"
                                type="button"
                                @click="fetchAttachments(page)"
                            >
                                {{ page }}
                            </button>
                        </li>
                        <li
                            class="page-item"
                            :class="{ disabled: !pagination.next_page_url }"
                        >
                            <button
                                class="page-link"
                                type="button"
                                @click="
                                    fetchAttachments(
                                        pagination.current_page + 1,
                                    )
                                "
                                :disabled="!pagination.next_page_url"
                            >
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
import { computed, ref, onMounted } from "vue";

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

const typeClassMap = {
    CV: "type-cv",
    cv: "type-cv",
    "Surat Lamaran": "type-letter",
    surat_lamaran: "type-letter",
    Portfolio: "type-portfolio",
    portfolio: "type-portfolio",
    Sertifikat: "type-certificate",
    sertifikat: "type-certificate",
    Certificate: "type-certificate",
    certificate: "type-certificate",
    Transkrip: "type-transcript",
    transkrip: "type-transcript",
    Transcript: "type-transcript",
    transcript: "type-transcript",
    Other: "type-other",
    other: "type-other",
};

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
        fetchAttachments();
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

//==========================Tampilkan Lampiran==========================

const attachments = ref([]);
const pagination = ref({});

const fetchAttachments = async (page = 1) => {
    isLoading.value = true;
    try {
        const response = await api.get(`/attachments?page=${page}`);
        attachments.value = response.data.data.map((att) => ({
            id: att.id,
            name: att.name,
            size: (att.file_size / 1024).toFixed(2) + " KB",
            type: att.type,
            uploadedAt: new Date(att.created_at).toLocaleDateString("id-ID", {
                day: "2-digit",
                month: "long",
                year: "numeric",
            }),
            isDefault: att.is_default,
            icon:
                att.type === "cv"
                    ? "bi bi-file-earmark-person-fill"
                    : att.type === "surat_lamaran"
                      ? "bi bi-file-earmark-text-fill"
                      : att.type === "portfolio"
                        ? "bi bi-folder-fill"
                        : att.type === "sertifikat"
                          ? "bi bi-award-fill"
                          : att.type === "transkrip"
                            ? "bi bi-journal-text"
                            : "bi bi-file-earmark-fill",
        }));
        pagination.value = response.data;
    } catch (error) {
        Swal.fire({
            title: "Gagal!",
            text: "Terjadi kesalahan saat mengambil data lampiran",
            icon: "error",
        });
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchAttachments();
});
//==========================Tampilkan Lampiran==========================

//==========================Hapus Lampiran==========================
const deleteAttachment = async (id) => {
    try {
        const result = await Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Lampiran yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        });

        if (result.isConfirmed) {
            await api.delete(`/attachments/${id}`);
            Swal.fire({
                title: "Berhasil!",
                text: "Lampiran berhasil dihapus",
                icon: "success",
            });
            fetchAttachments();
        }
    } catch (error) {
        Swal.fire({
            title: "Gagal!",
            text: "Terjadi kesalahan saat menghapus lampiran",
            icon: "error",
        });
    }
};

//==========================Hapus Lampiran==========================

//==========================Jadikan Default Lampiran==========================
const setDefaultAttachment = async (id) => {
    try {
        await api.put(`/attachments/${id}/set-default`);
        Swal.fire({
            title: "Berhasil!",
            text: "Lampiran berhasil dijadikan default",
            icon: "success",
        });
        fetchAttachments();
    } catch (error) {
        Swal.fire({
            title: "Gagal!",
            text: "Terjadi kesalahan saat menjadikan lampiran default",
            icon: "error",
        });
    }
};
//==========================Jadikan Default Lampiran==========================

//==========================Hapus Default Lampiran==========================
const removeDefaultAttachment = async (id) => {
    try {
        await api.put(`/attachments/${id}/destroy-default`);
        Swal.fire({
            title: "Berhasil!",
            text: "Lampiran berhasil dihapus sebagai default",
            icon: "success",
        });
        fetchAttachments();
    } catch (error) {
        Swal.fire({
            title: "Gagal!",
            text: "Terjadi kesalahan saat menghapus lampiran default",
            icon: "error",
        });
    }
};
//==========================Hapus Default Lampiran==========================

//==========================Download Lampiran==========================
const downloadAttachment = (file) => {
    window.location.href = `http://127.0.0.1:8000/api/attachments/${file.id}/download`;
};
//==========================Download Lampiran==========================
</script>
