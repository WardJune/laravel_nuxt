<template>
  <card title="Tambah Data Pegawai">
    <h5>Terdapat {{ count }} data pegawai</h5>
    <form @submit.prevent="save">
      <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="inputName"
            v-model="form.name"
          />
        </div>
      </div>
      <div class="form-group row">
        <label for="inputDateOfBirth" class="col-sm-2 col-form-label"
          >Tanggal Lahir</label
        >
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="inputDateOfBirth"
            v-model="form.date_of_birth"
          />
        </div>
      </div>
      <div class="form-group row">
        <label for="inputJobTitle" class="col-sm-2 col-form-label"
          >Job Title</label
        >
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="inputJobTitle"
            v-model="form.job_title"
          />
        </div>
      </div>
      <button class="btn btn-info" :disabled="loading">Update</button>
    </form>
  </card>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  middleware: "auth",

  head() {
    return { title: "Update Data Pegawai" };
  },

  async asyncData(content) {
    let res = (await axios.get(`employee/${content.params.id}`)).data;
    let form = res.model;
    return {
      form,
    };
  },

  data() {
    return {
      loading: false,
    };
  },
  methods: {
    async save() {
      this.loading = true;
      let res = (
        await axios.patch(`employee/${this.$route.params.id}`, this.form)
      ).data;
      this.loading = false;
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Data berhasil diperbaharui",
        confirmButtonText: "ok",
      });
    },
  },
};
</script>
