<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3'

const form = useForm({
    name: null,
    step: 1,
    email: null,
    password: null,
})

let submit = () => {
    const url = route('register'); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
</script>
<template>

    <Head>
        <title>Register Now</title>
    </Head>
    <div class="d-flex justify-center h-auto my-15 align-center ">

        <v-form @submit.prevent="submit" class="w-100">
            <v-card class="mx-auto w-100 pa-8 pb-8" elevation="8" max-width="448" rounded="lg">
                <div class=" text-center text-h4 mb-5 text-medium-emphasis">Register Now</div>
                <div class="text-subtitle-1 text-medium-emphasis">Full Name</div>

                <v-text-field density="compact" placeholder="Full Name" v-model="form.name" class="mb-3"
                    :error-messages="errors.name" prepend-inner-icon="mdi-account" variant="outlined"></v-text-field>


                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field density="compact" placeholder="Email address" v-model="form.email" class="mb-3"
                    :error-messages="errors.email" prepend-inner-icon="mdi-email-outline"
                    variant="outlined"></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                    Password
                </div>

                <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" class="mb-3"
                    :type="visible ? 'text' : 'password'" density="compact" placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline" v-model="form.password" variant="outlined"
                    :error-messages="errors.password" @click:append-inner="visible = !visible"></v-text-field>

                <v-btn class="mb-8" color="blue" size="large" variant="tonal" type="submit" block>
                    Next
                </v-btn>

                <v-card-text class="text-center">
                    <Link class="text-blue text-decoration-none" :href="route('login')">
                    Log In
                    </Link>
                </v-card-text>
            </v-card>
        </v-form>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3"
export default {
    data: () => ({
        visible: false,
    }),
    props: { errors: Object },
    components: { Link }
}
</script>
