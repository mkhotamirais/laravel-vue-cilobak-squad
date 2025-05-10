<script setup>
import PaginationInput from "@/Components/PaginationInput.vue";
import CardSchedule from "@/Components/CardSchedule.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  schedules: Object,
  msg: String,
  searchTerm: String,
  institusiTerm: String,
  userTerm: String,
  userid: String,
});

const params = route().params;
const page = usePage();
const user = computed(() => page.props.auth.user);

const formSearch = { search: props.searchTerm };
const formInstitusi = { institusi: props.institusiTerm };

const search = () => {
  router.get(route("home"), {
    search: formSearch.search || null,
    institusi: props.institusiTerm || null,
    userid: props.userid || null,
  });
};

const selectInstitusi = () => {
  router.get(route("home"), {
    institusi: formInstitusi.institusi,
    search: props.searchTerm || null,
    userid: props.userid || null,
  });
};

const deleteSchedule = (id) => {
  if (confirm("Yakin ingin hapus?")) {
    router.delete(route("jadwal.destroy", id), {
      preserveScroll: true,
    });
  }
};
</script>

<template>
  <!-- header -->
  <div class="container mt-4">
    <div v-if="user && user.role === 'admin'">
      <Link :href="route('jadwal.create')" class="btn w-fit mb-2">
        Create Schedule
      </Link>
      <!-- <SessMsg :msg="msg" /> -->
    </div>
  </div>
  <section class="">
    <div class="sticky top-16 bg-light dark:bg-dark py-4">
      <div
        class="container grid grid-cols-2 sm:flex gap-2 items-center justify-end"
      >
        <form @change.prevent="selectInstitusi">
          <select
            name="institusi"
            id="institusi"
            class="h-10 border px-2 border-primary bg-light dark:bg-dark rounded-md w-full sm:w-56"
            v-model="formInstitusi.institusi"
          >
            <option :value="null">Semua Institusi</option>
            <option value="ptiq_h">PTIQ H</option>
            <option value="pku_b">PKU B</option>
            <option value="pku_p">PKU P</option>
            <option value="ptiq_g">PTIQ G</option>
          </select>
        </form>
        <form
          @submit.prevent="search"
          class="flex border rounded-md border-primary items-center h-10 w-auto sm:w-56"
        >
          <input
            type="search"
            class="px-3 py-2 focus:outline-none w-full h-full"
            placeholder="Search.."
            v-model="formSearch.search"
          />
          <button type="submit" class="w-12 h-full text-lg" title="Search">
            <i class="fa-solid fa-magnifying-glass text-primary"></i>
          </button>
        </form>
        <div v-if="searchTerm || institusiTerm || userTerm">
          <button
            @click="
              router.get(route('home'), { ...params, search: null, page: null })
            "
            class="badge"
            v-if="searchTerm"
          >
            {{ searchTerm }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
          <button
            @click="
              router.get(route('home'), {
                ...params,
                institusi: null,
                page: null,
              })
            "
            class="badge uppercase"
            v-if="institusiTerm"
          >
            {{ institusiTerm.replace("_", " ") }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
          <button
            @click="
              router.get(route('home'), {
                ...params,
                userid: null,
                page: null,
              })
            "
            class="badge"
            v-if="userTerm"
          >
            {{ userTerm }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Schedules -->
    <div class="container">
      <div v-if="schedules.data.length">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <template v-for="(s, i) in schedules.data" :key="i">
            <CardSchedule
              :s="s"
              :userid="userid"
              :searchTerm="searchTerm"
              :institusiTerm="institusiTerm"
            >
              <div
                v-if="user && user.role === 'admin'"
                class="flex gap-4 items-center"
              >
                <Link
                  :href="route('jadwal.edit', s.id)"
                  class="text-green-500 hover:underline"
                >
                  Edit
                </Link>
                <button
                  @click="deleteSchedule(s.id)"
                  class="text-red-500 hover:underline"
                >
                  Delete
                </button>
              </div>
            </CardSchedule>
          </template>
        </div>
        <div class="flex justify-center mt-4">
          <PaginationInput :paginator="schedules" />
        </div>
      </div>
      <p v-else class="text-center text-gray-500 mt-8">
        Hasil pencarian
        <span class="font-bold italic">{{ searchTerm }}</span> tidak ditemukan
      </p>
    </div>
  </section>
</template>