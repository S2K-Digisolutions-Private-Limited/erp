<template>

    <Head>
        <title>Dashboard</title>
    </Head>
    <MainVue>
        <v-skeleton-loader type="card"></v-skeleton-loader>
    </MainVue>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import MainVue from '../components/Main.vue'
export default {
    components: {
        Head, MainVue
    }
};
</script>

<style></style>
