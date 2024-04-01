<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
</script>
<template>

    <Head>
        <title>All Sections</title>
    </Head>
    <main-vue>
        <v-card>
            <div class="d-flex align-center w-100 px-3 mt-4 mb-3">
                <h3>All Section</h3>
                <Link as="button" class="ms-auto" :href="route('section.create')">
                <v-btn color="blue" size="small">Add Section</v-btn>
                </Link>
            </div>
            <v-table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Student</th>
                        <th>Teacher</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in usePage().props.sections" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.class_name }}</td>
                        <td>{{ item.student_count }}</td>
                        <td>-</td>
                        <td>
                            <Link :href="item.editUrl" as="button">
                            <v-btn density="compact" icon="mdi-pencil" size="large" class="mx-2" title="Edit"></v-btn>
                            </Link>
                            <Link as="button" :href="item.deleteUrl" method="DELETE">
                            <v-btn density="compact" icon="mdi-delete" size="large" title="Delete"></v-btn>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </main-vue>
</template>

<script>

import MainVue from '../../../components/Main.vue'
export default {
    components: {
        Head,
        MainVue,
        Link,
    },

}
</script>

<style></style>
