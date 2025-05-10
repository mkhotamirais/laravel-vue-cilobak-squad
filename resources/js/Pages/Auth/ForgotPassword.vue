<script setup>
import SessMsg from "@/Components/SessMsg.vue";
import Input from "@/Components/Input.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({ msg: String });
const form = useForm({ email: "" });

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <Head title="Forgot Password" />

  <section class="container">
    <div
      class="max-w-lg mx-auto bg-white dark:bg-dark-2 my-12 p-8 rounded-lg shadow-lg"
    >
      <div class="mb-8 text-center">
        <p>
          Forgot your password? No problem. Just let us know your email address
          and we will email you a password reset link that will allow you to
          choose a new one.
        </p>
      </div>

      <SessMsg :msg="msg" />

      <form @submit.prevent="submit" class="space-y-6">
        <Input
          label="Email"
          icon="at"
          placeholder="example@email.com"
          v-model="form.email"
          :error="form.errors.email"
        />
        <button type="submit" class="btn" :disabled="form.processing">
          Send password reset link
        </button>
      </form>
    </div>
  </section>
</template>