import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../pages/Dashboard.vue";
import ApplyJobs from "../pages/ApplyJobs.vue";
import Templates from "../pages/Templates.vue";
import Attachments from "../pages/Attachments.vue";
import History from "../pages/History.vue";
import Login from "../pages/Login.vue";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
        meta: {
            title: "Dashboard",
        },
    },
    {
        path: "/apply-pekerjaan",
        name: "apply-jobs",
        component: ApplyJobs,
        meta: {
            title: "Apply Pekerjaan",
        },
    },
    {
        path: "/template",
        name: "templates",
        component: Templates,
        meta: {
            title: "Template",
        },
    },
    {
        path: "/lampiran",
        name: "attachments",
        component: Attachments,
        meta: {
            title: "Lampiran",
        },
    },
    {
        path: "/riwayat",
        name: "history",
        component: History,
        meta: {
            title: "Riwayat",
        },
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            title: "Login",
            layout: "blank",
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
