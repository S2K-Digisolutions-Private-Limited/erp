<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    id: 0,
    name: null,
    status: false,
    email: null,
    phone: null,
    hidden_password: null,

})

let submit = () => {
    const url = usePage().props.PortUrl?.toString(); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
</script>
<template>

    <Head>
        <title>Create Student</title>
    </Head>
    <MainVue>
        <v-card title="Create Student" prepend-icon="mdi-plus-circle" class="pb-4">
            <v-form @submit.prevent="submit">
                <v-row>

                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.name" :error-messages="errors.name"
                                label="Student Name"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.email" :error-messages="errors.email"
                                label="Student Email"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.phone" :error-messages="errors.phone"
                                label="Student Phone Number"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.hidden_password" :error-messages="errors.hidden_password"
                                label="Student Account Password"></v-text-field>
                        </v-sheet>
                    </v-col>
                    <hr>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.father_name" :error-messages="errors.father_name"
                                label="Father Name"></v-text-field>
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
export default {
    components: {
        MainVue,
        Head
    },
    props: { errors: Object }
}
</script>

<style>
.v-input__details {
    display: none;
}
</style>
