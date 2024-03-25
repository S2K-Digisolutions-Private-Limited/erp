<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
</script>
<template>

    <Head>
        <title>All Classes</title>
    </Head>
    <main-vue>
        <v-card>
            <div class="d-flex align-center w-100 px-3 mt-4 mb-3">
                <h3>All Class</h3>
                <Link as="button" class="ms-auto" :href="usePage().props.createUrl">
                <v-btn color="blue" size="small">Add Class</v-btn>
                </Link>
            </div>
            <v-table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Has Stream</th>
                        <th>Sections</th>
                        <th>Students</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in usePage().props.classes" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.has_stream == 1 ? 'Yes' : 'No' }}</td>
                        <td>{{ item.section_names }}</td>
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
