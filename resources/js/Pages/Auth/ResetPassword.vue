<script setup>
import Input from "@/Components/Input.vue";
import SessMsg from "@/Components/SessMsg.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({ token: String, email: String });

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.update"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Head title="Reset Password" />

  <section class="container">
    <div
      class="max-w-lg md:w-1/2 my-12 mx-auto bg-white dark:bg-dark-2 p-8 rounded-lg shadow-lg"
    >
      <div class="mb-8 text-center">
        <h1 class="h1">Enter your new password</h1>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        <Input
          label="Email"
          icon="at"
          v-model="form.email"
          :error="form.errors.email"
        />
        <Input
          label="Password"
          type="password"
          icon="key"
          v-model="form.password"
          :error="form.errors.password"
        />
        <Input
          label="Password Confirmation"
          type="password"
          icon="key"
          v-model="form.password_confirmation"
          :error="form.errors.password_confirmation"
        />

        <button type="submit" class="btn" :disabled="form.processing">
          Reset Password
        </button>
      </form>
    </div>
  </section>
</template>