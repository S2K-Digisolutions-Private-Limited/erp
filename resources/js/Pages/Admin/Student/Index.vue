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
            <v-data-table :headers="headers" :items="students" item-key="id" :search="search">
                <template v-slot:item.class="{ item }">
                    {{ item.class.name }} <!-- Assuming class object has a 'name' property -->
                </template>
                <template v-slot:item.section="{ item }">
                    {{ item.section.name }} <!-- Assuming section object has a 'name' property -->
                </template>
                <template v-slot:item.stream="{ item }">
                    {{ student && student.section && student.section.name }}
                    <!-- Assuming stream object has a 'name' property -->
                </template>
                <template v-slot:item.status="{ item }">
                    {{ item.has_stream == 1 ? 'Yes' : 'No' }} <!-- Assuming stream object has a 'name' property -->
                </template>
                <template v-slot:item.action="{ item }">
                    <Link :href="route('student.edit', item.student_id)">
                    <v-icon>mdi-pencil</v-icon>
                    </Link>
                </template>
            </v-data-table>
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
    },
    data() {
        return {
            headers: [
                { title: 'ID', value: 'id', sortable: true },
                { title: 'Name', value: 'name', sortable: true },
                { title: 'Father Name', value: 'father_name', sortable: true },
                { title: 'Student ID', value: 'student_id', sortable: true },
                { title: 'Status', value: 'status' },
                { title: 'Email', value: 'email', sortable: true },
                { title: 'Class', value: 'class' }, // Use a slot to render nested data
                { title: 'Section', value: 'section' }, // Use a slot to render nested data
                { title: 'Stream', value: 'stream' }, // Use a slot to render nested data
                { title: 'Action', value: 'action' }, // Use a slot to render nested data
            ],
            students: usePage().props.students,
            search: '',
        };
    }
}
</script>

<style></style>
