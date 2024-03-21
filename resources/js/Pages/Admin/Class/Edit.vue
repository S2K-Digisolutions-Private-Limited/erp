<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    id: usePage().props.class.id ?? 0,
    name: usePage().props.class.name ?? null,
    has_stream: usePage().props.class.has_stream == 1 ? true : false,
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
        <title>Edit Class</title>
    </Head>
    <main-vue>
        <v-card title="Edit Class" prepend-icon="mdi-plus-circle" class="pb-4">
            <v-form @submit.prevent="submit">
                <v-row>

                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.name" :error-messages="errors.name" label="Class Name"
                                autofocus></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class=" mx-5">
                            <v-switch label="Has Stream" v-model="form.has_stream" color="blue"></v-switch>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12">
                        <v-sheet class="ps-5 text-center">
                            <v-btn color="blue" text="Update Class" type="submit"></v-btn>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-form>
        </v-card>
    </main-vue>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3'
import MainVue from '../../../components/Main.vue';
export default {
    components: {
        Head,
        MainVue,
        Link,
    },
    props: { errors: Object, class: Object }
}
</script>

<style>
.v-input__details {
    display: none;
}
</style>
