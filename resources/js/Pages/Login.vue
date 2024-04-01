<script setup>
import { useForm, Head } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
});

// let loading = false;

let submit = () => {
    // loading = true;
    const url = route('login'); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
</script>
<template>

    <Head>
        <title>Login</title>
    </Head>
    <div style="min-height: 100vh;" class="d-flex justify-center align-center">
        <v-form @submit.prevent="submit" class="w-100">
            <v-card class="mx-auto w-100 pa-8 pb-8" elevation="8" max-width="448" rounded="lg">
                <div class=" text-center text-h4 mb-5 text-medium-emphasis">Login</div>
                <div class="text-subtitle-1 text-medium-emphasis">Email</div>

                <v-text-field density="compact" placeholder="Email address" prepend-inner-icon="mdi-email-outline"
                    class="mb-3" v-model="form.email" :error-messages="errors.email" variant="outlined"></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
                    Password
                </div>

                <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'" v-model="form.password" :error-messages="errors.password"
                    density="compact" placeholder="Enter your password" prepend-inner-icon="mdi-lock-outline"
                    class="mb-3" variant="outlined" @click:append-inner="visible = !visible"></v-text-field>

                <v-btn class="mb-8" color="blue" size="large" variant="tonal" block type="submit">
                    Log In
                </v-btn>

                <v-card-text class="text-center">
                    <Link class="text-blue text-decoration-none" :href="route('register')">
                    Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
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
