<template>

    <Head>
        <title>Dashboard</title>
    </Head>
    <MainVue>
        <Link as="button" :href="route('class.index')">
        <v-btn stacked>
            <v-badge color="primary" class="mb-2" :content="counts.class">
                <v-icon icon="mdi-google-classroom"></v-icon>
            </v-badge>
            Class
        </v-btn>
        </Link>
        <Link as="button" :href="route('section.index')">
        <v-btn class="ms-2" stacked>
            <v-badge color="primary" class="mb-2" :content="counts.section">
                <v-icon icon="mdi-google-classroom"></v-icon>
            </v-badge>
            Section
        </v-btn>
        </Link>
        <Link as="button" :href="route('stream.index')">
        <v-btn class="ms-2" stacked>
            <v-badge color="primary" class="mb-2" :content="counts.stream">
                <v-icon icon="mdi-google-classroom"></v-icon>
            </v-badge>
            Stream
        </v-btn>
        </Link>
        <Link as="button" :href="route('subject.index')">
        <v-btn class="ms-2" stacked>
            <v-badge color="primary" class="mb-2" :content="counts.subject">
                <v-icon icon="mdi-text-long"></v-icon>
            </v-badge>
            Subject
        </v-btn>
        </Link>
        <Link as="button" :href="route('student.index')">
        <v-btn class="ms-2" stacked>
            <v-badge color="primary" class="mb-2" :content="counts.student">
                <v-icon icon="mdi-account-school"></v-icon>
            </v-badge>
            Students
        </v-btn>
        </Link>

    </MainVue>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import MainVue from '../components/Main.vue'
export default {
    components: {
        Head, MainVue, Link
    },
    props: { counts: Array }
};
</script>

<style></style>
