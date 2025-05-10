<script setup>
import Input from "@/Components/Input.vue";
import CheckBox from "@/Components/CheckBox.vue";
import SessMsg from "@/Components/SessMsg.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({ email: "", password: "", remember: null });

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <Head title="Login" />

  <section class="">
    <div class="container">
      <div
        class="p-6 lg:p-8 my-12 max-w-md bg-white dark:bg-dark-2 mx-auto rounded-lg shadow"
      >
        <div class="mb-4">
          <h1 class="h1 mb-3">login</h1>
          <p>
            Belum punya akun?
            <Link :href="route('register')" class="link">Register</Link>
          </p>
        </div>

        <SessMsg :msg="form.errors.msg" :isError="true" />

        <form @submit.prevent="submit" class="space-y-6">
          <Input
            label="Email"
            icon="at"
            v-model="form.email"
            placeholder="example@email.com"
            :error="form.errors.email"
          />
          <Input
            label="Password"
            type="password"
            placeholder="********"
            icon="key"
            v-model="form.password"
            :error="form.errors.password"
          />

          <div class="flex items-center justify-between">
            <CheckBox name="remember" v-model="form.remember">
              Remember me
            </CheckBox>
            <Link :href="route('password.request')" class="link"
              >Forgot your password?</Link
            >
          </div>

          <button type="submit" :disabled="form.processing" class="btn">
            Login
          </button>
        </form>
      </div>
    </div>
  </section>
</template>