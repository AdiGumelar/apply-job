<template>
    <MainLayout v-if="route.meta.layout !== 'blank'" />
    <RouterView v-else />
</template>

<script setup>
import MainLayout from "./layouts/MainLayout.vue";
import { useRoute } from "vue-router";

const route = useRoute();
</script>
