<template>
    <div class="history-page">
        <section class="history-hero mb-4">
            <div>
                <p class="section-label mb-2">Application Log</p>
                <h2 class="history-title mb-2">Riwayat Lamaran</h2>
                <p class="history-subtitle mb-0">
                    Pantau semua email lamaran, status pengiriman, lampiran, dan log aktivitas dari satu tabel.
                </p>
            </div>
        </section>

        <section class="app-card history-filter-card mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4 col-xl-3">
                    <label class="premium-label">Status</label>
                    <select v-model="filters.status" class="form-select history-filter-control">
                        <option value="Semua">Semua Status</option>
                        <option value="Berhasil">Berhasil</option>
                        <option value="Pending">Pending</option>
                        <option value="Gagal">Gagal</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-xl-3">
                    <label class="premium-label">Tanggal</label>
                    <input v-model="filters.date" type="date" class="form-control history-filter-control" />
                </div>
                <div class="col-12 col-md-4 col-xl-6">
                    <label class="premium-label">Search</label>
                    <div class="history-search">
                        <i class="bi bi-search"></i>
                        <input
                            v-model="filters.search"
                            type="search"
                            class="form-control history-filter-control"
                            placeholder="Cari perusahaan, posisi, atau email..."
                        />
                    </div>
                </div>
            </div>
        </section>

        <section class="app-card history-table-card">
            <div class="card-heading">
                <div>
                    <p class="section-label mb-1">Data Lamaran</p>
                    <h2 class="content-title mb-0">Daftar Riwayat</h2>
                </div>
                <button class="btn btn-light app-soft-button" type="button">
                    <i class="bi bi-download me-2"></i>
                    Export
                </button>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0 app-table history-table">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Posisi</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="application in filteredApplications" :key="application.id">
                            <td>
                                <div class="company-cell">
                                    <span class="company-avatar">{{ application.initial }}</span>
                                    <div>
                                        <div class="fw-semibold">{{ application.company }}</div>
                                        <span class="text-muted small">{{ application.location }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ application.position }}</td>
                            <td>{{ application.email }}</td>
                            <td>
                                <span class="badge status-badge" :class="application.statusClass">
                                    {{ application.status }}
                                </span>
                            </td>
                            <td>{{ application.dateLabel }}</td>
                            <td>
                                <button
                                    class="btn btn-outline-primary btn-sm history-detail-button"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#historyDetailModal"
                                    @click="selectedApplication = application"
                                >
                                    <i class="bi bi-eye me-1"></i>
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav class="history-pagination mt-4" aria-label="Pagination riwayat lamaran">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <button class="page-link" type="button">Previous</button>
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
                        <button class="page-link" type="button">Next</button>
                    </li>
                </ul>
            </nav>
        </section>

        <div
            id="historyDetailModal"
            class="modal fade"
            tabindex="-1"
            aria-labelledby="historyDetailModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content premium-modal history-modal">
                    <div class="modal-header">
                        <div>
                            <p class="section-label mb-1">Detail Lamaran</p>
                            <h2 id="historyDetailModalLabel" class="modal-title">
                                {{ selectedApplication.company }} - {{ selectedApplication.position }}
                            </h2>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-12 col-lg-7">
                                <article class="history-detail-panel">
                                    <h3>Isi Email</h3>
                                    <p>{{ selectedApplication.emailBody }}</p>
                                </article>

                                <article class="history-detail-panel">
                                    <h3>Surat Lamaran</h3>
                                    <p>{{ selectedApplication.coverLetter }}</p>
                                </article>
                            </div>

                            <div class="col-12 col-lg-5">
                                <article class="history-detail-panel">
                                    <h3>Lampiran</h3>
                                    <div class="history-attachment-list">
                                        <span v-for="attachment in selectedApplication.attachments" :key="attachment">
                                            <i class="bi bi-paperclip"></i>
                                            {{ attachment }}
                                        </span>
                                    </div>
                                </article>

                                <article class="history-detail-panel">
                                    <h3>Log Email</h3>
                                    <div class="email-log-list">
                                        <div v-for="log in selectedApplication.logs" :key="log.time" class="email-log-item">
                                            <span>{{ log.time }}</span>
                                            <strong>{{ log.message }}</strong>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light app-soft-button" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, reactive, ref } from "vue";

const filters = reactive({
    status: "Semua",
    date: "",
    search: "",
});

const applications = [
    {
        id: 1,
        initial: "MD",
        company: "Mediatama Digital",
        location: "Jakarta Selatan",
        position: "Frontend Developer",
        email: "hr@mediatama.test",
        status: "Berhasil",
        statusClass: "status-success",
        date: "2026-07-01",
        dateLabel: "01 Jul 2026",
        emailBody: "Email lamaran berhasil dikirim menggunakan template Profesional Singkat.",
        coverLetter: "Surat lamaran formal untuk posisi Frontend Developer telah dilampirkan.",
        attachments: ["CV_Ari_Recruiter.pdf", "Portfolio_Frontend.pdf"],
        logs: [
            { time: "09:12", message: "Email dibuat" },
            { time: "09:13", message: "Lampiran divalidasi" },
            { time: "09:14", message: "Email berhasil dikirim" },
        ],
    },
    {
        id: 2,
        initial: "AC",
        company: "Astra Career",
        location: "Hybrid",
        position: "Vue Developer",
        email: "career@astra.test",
        status: "Pending",
        statusClass: "status-warning",
        date: "2026-06-30",
        dateLabel: "30 Jun 2026",
        emailBody: "Email lamaran sudah masuk antrean pengiriman dan menunggu retry otomatis.",
        coverLetter: "Cover letter modern dipilih untuk menonjolkan pengalaman Vue dan Laravel.",
        attachments: ["CV_ATS_Version.pdf", "Sertifikat_Vue_Laravel.pdf"],
        logs: [
            { time: "14:20", message: "Email dibuat" },
            { time: "14:21", message: "Menunggu koneksi SMTP" },
        ],
    },
    {
        id: 3,
        initial: "NT",
        company: "Nusa Talent",
        location: "Remote",
        position: "Laravel Engineer",
        email: "jobs@nusatalent.test",
        status: "Gagal",
        statusClass: "status-danger",
        date: "2026-06-28",
        dateLabel: "28 Jun 2026",
        emailBody: "Email gagal dikirim karena alamat tujuan menolak pesan.",
        coverLetter: "Surat lamaran formal telah disiapkan namun belum terkirim.",
        attachments: ["CV_Ari_Recruiter_2026.pdf"],
        logs: [
            { time: "10:02", message: "Email dibuat" },
            { time: "10:03", message: "SMTP menolak alamat penerima" },
        ],
    },
];

const selectedApplication = ref(applications[0]);

const filteredApplications = computed(() => {
    const search = filters.search.toLowerCase().trim();

    return applications.filter((application) => {
        const matchesStatus = filters.status === "Semua" || application.status === filters.status;
        const matchesDate = !filters.date || application.date === filters.date;
        const matchesSearch =
            !search ||
            application.company.toLowerCase().includes(search) ||
            application.position.toLowerCase().includes(search) ||
            application.email.toLowerCase().includes(search);

        return matchesStatus && matchesDate && matchesSearch;
    });
});
</script>
