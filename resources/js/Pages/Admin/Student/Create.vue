<script setup>
import { useForm } from '@inertiajs/vue3'
// watch
const form = useForm({
    id: 0,
    name: null,
    status: true,
    email: null,
    phone: null,
    gender: 'Male',
    hidden_password: null,
    father_name: null,
    mother_name: null,
    father_number: null,
    mother_number: null,
    whatsapp_number: null,
    primary_email: null,
    full_address: null,
    roll_number: null,
    class_id: null,
    section_id: null,
    stream_id: null,
});

let submit = () => {
    const url = usePage().props.PortUrl?.toString(); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
let classes = usePage().props.classes;
let classChangeHandler = () => {
    console.log('Class selection changed'); // Log message to verify if the function is called
    form.section_id = null; // Reset section_id when class changes
    form.stream_id = null; // Reset stream_id when class changes
}
watch(() => form.class_id, (newValue, oldValue) => {
    console.log('Class selection changed:', newValue); // Log the new value when class selection changes
    classChangeHandler(); // Call the classChangeHandler function to reset section and stream IDs
});

const getSections = () => {
    if (form.class_id) {
        const selectedClass = classes.find(c => c.id === form.class_id);
        if (selectedClass && selectedClass.sections) {
            return selectedClass.sections;
        }
    }
    return [];
}

const getStreams = () => {
    if (form.class_id) {
        const selectedClass = classes.find(c => c.id === form.class_id);
        if (selectedClass && selectedClass.streams) {
            return selectedClass.streams;
        }
    }
    return [];
}


</script>
<template>

    <Head>
        <title>Create Student</title>
    </Head>
    <MainVue>
        <v-card class="pb-4">
            <v-form @submit.prevent="submit">
                <v-row>
                    <v-col cols="12">
                        <h2 class="ms-5 mt-3">Student Details</h2>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.name" :error-messages="errors.name"
                                label="Student Name"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.email" :error-messages="errors.email"
                                label="Student Email For Login"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.phone" :error-messages="errors.phone"
                                label="Student Phone Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-select label="Gender" v-model="form.gender" :error-messages="errors.gender"
                                :items="['Male', 'Female']"></v-select>
                        </v-sheet>
                    </v-col>
                    <!-- jbdjn -->
                    <v-col cols="12">
                        <v-divider class="border-opacity-75" color="success"></v-divider>
                        <h2 class="ms-5 mt-3">Class Details</h2>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-select v-model="form.class_id" :items="classes" label="Select Class" item-title="name"
                                item-value="id" :error-messages="errors.class_id"
                                @change="classChangeHandler"></v-select>
                        </v-sheet>
                    </v-col>


                    <v-col v-if="form.class_id" cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-select v-model="form.section_id" :items="getSections()" label="Select Section"
                                item-title="name" item-value="id" :error-messages="errors.section_id"></v-select>
                        </v-sheet>
                    </v-col>

                    <v-col v-if="form.class_id" cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-select v-model="form.stream_id" :items="getStreams()" label="Select Stream"
                                item-title="name" item-value="id" :error-messages="errors.stream_id"></v-select>
                        </v-sheet>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field type="number" min="0" v-model="form.roll_number"
                                :error-messages="errors.roll_number" label="Roll Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <!-- jbejbs -->
                    <v-col cols="12">
                        <v-divider class="border-opacity-75" color="success"></v-divider>
                        <h2 class="ms-5 mt-3">Parent Details</h2>
                    </v-col>
                    <!-- Parent Box -->
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.father_name" :error-messages="errors.father_name"
                                label="Father Name"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.mother_name" :error-messages="errors.mother_name"
                                label="Mother Name"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.father_number" :error-messages="errors.father_number"
                                label="Father Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.mother_number" :error-messages="errors.mother_number"
                                label="Mother Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.whatsapp_number" :error-messages="errors.whatsapp_number"
                                label="WhatsApp Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.primary_email" :error-messages="errors.primary_email"
                                label="Email For Parent Login"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12">
                        <v-sheet class="mx-5 mt-1">
                            <v-textarea label="Full Address" v-model="form.full_address"
                                :error-messages="errors.full_address"></v-textarea>
                        </v-sheet>
                    </v-col>

                    <v-col cols="12">
                        <v-divider class="border-opacity-75" color="success"></v-divider>
                        <h2 class="ms-5 mt-3">Account Details</h2>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-1">
                            <v-text-field v-model="form.hidden_password" :error-messages="errors.hidden_password"
                                label="Student Account Password"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5">
                            <v-switch label="Status" v-model="form.status" color="blue"></v-switch>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12">
                        <v-sheet class="ps-5 text-center">
                            <v-btn color="blue" text="Create Student" type="submit"></v-btn>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-form>
        </v-card>
    </MainVue>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3'
import MainVue from '../../../components/Main.vue'
import { watch } from 'vue';
export default {
    components: {
        MainVue,
        Head
    },
    props: { errors: Object, classes: Array },
}
</script>

<style>
.v-input__details {
    display: none;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}
</style>
