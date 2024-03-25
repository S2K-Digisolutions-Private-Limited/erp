<template>
    <MainVue>

        <Head>
            <title>All Student</title>
        </Head>
        <v-card>
            <div class="d-flex align-center w-100 px-3 mt-4 mb-3">
                <h3>All Student</h3>
                <Link as="button" class="ms-auto" :href="route('student.create')">
                <v-btn color="blue" size="small">Add Student</v-btn>
                </Link>
            </div>
        </v-card>
    </MainVue>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3'
import MainVue from '../../../components/Main.vue'
export default {
    components: {
        MainVue,
        Link,
        Head
    }
}
</script>

<style></style>
