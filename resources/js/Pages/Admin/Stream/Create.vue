<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    id: 0,
    name: null,
    class_id: null,
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
        <title>Create Stream</title>
    </Head>
    <main-vue>
        <v-card title="Create Stream" prepend-icon="mdi-plus-circle" class="pb-4">
            <v-form @submit.prevent="submit">
                <v-row>

                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-text-field v-model="form.name" :error-messages="errors.name" label="Stream Name"
                                autofocus></v-text-field>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-sheet class="mx-5 mt-3">
                            <v-select v-model="form.class_id" :items="usePage().props.classes" label="Select Class"
                                item-title="name" item-value="id" :error-messages="errors.class_id"></v-select>
                        </v-sheet>
                    </v-col>
                    <v-col cols="12">
                        <v-sheet class="ps-5 text-center">
                            <v-btn color="blue" text="Create Stream" type="submit"></v-btn>
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
    props: { errors: Object }
}
</script>

<style>
.v-input__details {
    display: none;
}
</style>
