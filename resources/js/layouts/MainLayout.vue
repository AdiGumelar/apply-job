<template>
    <div class="app-shell" :class="{ 'sidebar-collapsed': isCollapsed }">
        <aside class="app-sidebar">
            <div class="sidebar-brand">
                <div class="brand-mark">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <div class="brand-copy">
                    <span class="brand-title">Dashboard</span>
                    <span class="brand-subtitle">Auto Apply</span>
                </div>
            </div>

            <nav class="sidebar-menu">
                <RouterLink
                    v-for="item in menuItems"
                    :key="item.name"
                    :to="item.to"
                    class="sidebar-link"
                    active-class="active"
                    :title="isCollapsed ? item.label : null"
                >
                    <i :class="item.icon"></i>
                    <span>{{ item.label }}</span>
                </RouterLink>
            </nav>

            <button class="sidebar-link sidebar-logout" type="button" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </aside>

        <div class="app-main">
            <header class="top-navbar">
                <div class="d-flex align-items-center gap-3 min-w-0">
                    <button class="icon-button" type="button" @click="toggleSidebar" aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="min-w-0">
                        <p class="page-kicker mb-1">Dashboard Auto Apply</p>
                        <h1 class="page-title mb-0 text-truncate">{{ pageTitle }}</h1>
                    </div>
                </div>

                <div class="topbar-actions">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="search" class="form-control" placeholder="Cari pekerjaan..." />
                    </div>

                    <button class="icon-button notification-button" type="button" aria-label="Notifikasi">
                        <i class="bi bi-bell"></i>
                        <span class="notification-dot"></span>
                    </button>

                    <button class="user-button" type="button">
                        <span class="user-avatar">AR</span>
                        <span class="user-info">
                            <span class="user-name">Ari Recruiter</span>
                            <span class="user-role">Job Hunter</span>
                        </span>
                    </button>
                </div>
            </header>

            <main class="content-area">
                <RouterView />
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const isCollapsed = ref(false);

const menuItems = [
    {
        label: "Dashboard",
        icon: "bi bi-grid-1x2-fill",
        to: "/",
        name: "dashboard",
    },
    {
        label: "Apply Pekerjaan",
        icon: "bi bi-send-fill",
        to: "/apply-pekerjaan",
        name: "apply-jobs",
    },
    {
        label: "Template",
        icon: "bi bi-file-earmark-text-fill",
        to: "/template",
        name: "templates",
    },
    {
        label: "Lampiran",
        icon: "bi bi-paperclip",
        to: "/lampiran",
        name: "attachments",
    },
    {
        label: "Riwayat",
        icon: "bi bi-clock-history",
        to: "/riwayat",
        name: "history",
    },
];

const pageTitle = computed(() => route.meta.title || "Dashboard");

const toggleSidebar = () => {
    isCollapsed.value = !isCollapsed.value;
};
</script>
