<template>
    <div class="dashboard-page">
        <div class="dashboard-intro mb-4">
            <div>
                <p class="section-label mb-2">Overview</p>
                <h2 class="dashboard-title mb-2">Dashboard Auto Apply Pekerjaan</h2>
                <p class="dashboard-subtitle mb-0">
                    Pantau performa lamaran, status terbaru, dan aksi cepat dalam satu tampilan.
                </p>
            </div>
        </div>

        <div class="row g-4 dashboard-stats mb-4">
            <div v-for="stat in stats" :key="stat.label" class="col-12 col-sm-6 col-xl-3">
                <article class="dashboard-stat-card h-100" :class="stat.variant">
                    <div class="dashboard-stat-icon">
                        <i :class="stat.icon"></i>
                    </div>
                    <p class="dashboard-stat-label mb-2">{{ stat.label }}</p>
                    <div class="d-flex align-items-end justify-content-between gap-3">
                        <h3 class="dashboard-stat-value mb-0">{{ stat.value }}</h3>
                        <span class="dashboard-stat-note">{{ stat.note }}</span>
                    </div>
                </article>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-8">
                <section class="app-card application-history-card">
                    <div class="card-heading">
                        <div>
                            <p class="section-label mb-1">Aktivitas</p>
                            <h2 class="content-title mb-0">Riwayat Lamaran Terbaru</h2>
                        </div>
                        <button class="btn btn-light btn-sm app-soft-button">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Refresh
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0 app-table">
                            <thead>
                                <tr>
                                    <th>Perusahaan</th>
                                    <th>Posisi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="application in applications" :key="application.company">
                                    <td>
                                        <div class="company-cell">
                                            <span class="company-avatar">{{ application.initial }}</span>
                                            <div>
                                                <div class="fw-semibold">{{ application.company }}</div>
                                                <span class="text-muted small">{{ application.location }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ application.role }}</td>
                                    <td>{{ application.date }}</td>
                                    <td>
                                        <span class="badge status-badge" :class="application.statusClass">
                                            {{ application.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <div class="col-12 col-xl-4">
                <section class="app-card quick-action-card h-100">
                    <div class="card-heading">
                        <div>
                            <p class="section-label mb-1">Shortcut</p>
                            <h2 class="content-title mb-0">Quick Action</h2>
                        </div>
                    </div>

                    <p class="quick-action-copy mb-4">
                        Akses fitur utama lebih cepat untuk menjaga proses apply tetap lancar.
                    </p>

                    <div class="quick-action-list">
                        <RouterLink
                            v-for="action in quickActions"
                            :key="action.label"
                            :to="action.to"
                            class="quick-action-button"
                        >
                            <span class="quick-action-icon" :class="action.variant">
                                <i :class="action.icon"></i>
                            </span>
                            <span>{{ action.label }}</span>
                            <i class="bi bi-arrow-right-short ms-auto"></i>
                        </RouterLink>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script setup>
const stats = [
    {
        label: "Total Lamaran",
        value: "248",
        note: "+18%",
        icon: "bi bi-briefcase-fill",
        variant: "stat-gradient-primary",
    },
    {
        label: "Berhasil",
        value: "42",
        note: "+7",
        icon: "bi bi-check-circle-fill",
        variant: "stat-gradient-success",
    },
    {
        label: "Gagal",
        value: "16",
        note: "-3",
        icon: "bi bi-x-circle-fill",
        variant: "stat-gradient-danger",
    },
    {
        label: "Template",
        value: "8",
        note: "Aktif",
        icon: "bi bi-file-earmark-text-fill",
        variant: "stat-gradient-info",
    },
];

const applications = [
    {
        initial: "MD",
        company: "Mediatama Digital",
        location: "Jakarta Selatan",
        role: "Frontend Developer",
        status: "Berhasil",
        statusClass: "status-success",
        date: "01 Jul 2026",
    },
    {
        initial: "AC",
        company: "Astra Career",
        location: "Hybrid",
        role: "Vue Developer",
        status: "Review",
        statusClass: "status-primary",
        date: "30 Jun 2026",
    },
    {
        initial: "NT",
        company: "Nusa Talent",
        location: "Remote",
        role: "Laravel Engineer",
        status: "Pending",
        statusClass: "status-warning",
        date: "28 Jun 2026",
    },
    {
        initial: "KT",
        company: "Karya Teknologi",
        location: "Bandung",
        role: "Fullstack Developer",
        status: "Gagal",
        statusClass: "status-danger",
        date: "26 Jun 2026",
    },
];

const quickActions = [
    {
        label: "Apply Sekarang",
        icon: "bi bi-send-fill",
        to: "/apply-pekerjaan",
        variant: "quick-primary",
    },
    {
        label: "Kelola Template",
        icon: "bi bi-file-earmark-text-fill",
        to: "/template",
        variant: "quick-success",
    },
    {
        label: "Kelola Lampiran",
        icon: "bi bi-paperclip",
        to: "/lampiran",
        variant: "quick-danger",
    },
];
</script>
