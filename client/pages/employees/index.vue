<template>
  <card title="Daftar Pegawai">
    <div class="d-flex justify-content-between">
      <h5>Terdapat {{ count }} data pegawai</h5>
      <router-link to="employee/create" class="btn btn-sm btn-info">
        Tambah Data Pegawai
      </router-link>
    </div>
    <div class="row mt-3">
      <div
        class="col-md-3 mb-3"
        v-for="employee in employees"
        :key="employee.id"
      >
        <div class="card">
          <img
            src="https://via.placeholder.com/340x120/FFB6C1/000000"
            alt="Cover"
            class="card-img-top"
          />
          <div class="card-body text-center">
            <img
              src="https://bootdey.com/img/Content/avatar/avatar7.png"
              style="width: 100px; margin-top: -65px"
              alt="User"
              class="img-fluid img-thumbnail rounded-circle border-0 mb-3"
            />
            <h5 class="card-title">{{ employee.name }}</h5>
            <p class="text-secondary mb-1">{{ employee.job_title }}</p>
            <p class="text-muted font-size-sm">{{ employee.date_of_birth }}</p>
          </div>
          <div class="card-footer d-flex justify-content-around">
            <router-link
              :to="'employee/update/' + employee.id"
              class="btn btn-warning"
            >
              Edit
            </router-link>
            <button class="btn btn-danger" @click="deleteData(employee)">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </card>
</template>

<style lang="scss" scoped>
body {
  margin-top: 20px;
  color: #1a202c;
  text-align: left;
  background-color: #e2e8f0;
}
.main-body {
  padding: 15px;
}
.card {
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  min-height: 312px;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 0 solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
}

.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1rem;
}

.gutters-sm {
  margin-right: -8px;
  margin-left: -8px;
}

.gutters-sm > .col,
.gutters-sm > [class*="col-"] {
  padding-right: 8px;
  padding-left: 8px;
}
.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}

.bg-gray-300 {
  background-color: #e2e8f0;
}
.h-100 {
  height: 100% !important;
}
.shadow-none {
  box-shadow: none !important;
}

.bg-white {
  background-color: #fff !important;
}
.btn-light {
  color: #1a202c;
  background-color: #fff;
  border-color: #cbd5e0;
}
.ml-2,
.mx-2 {
  margin-left: 0.5rem !important;
}

.card-footer:last-child {
  border-radius: 0 0 0.25rem 0.25rem;
}
.card-footer,
.card-header {
  display: flex;
  align-items: center;
}
.card-footer {
  padding: 0.5rem 1rem;
  background-color: #fff;
  border-top: 0 solid rgba(0, 0, 0, 0.125);
}
</style>
<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  middleware: "auth",
  // meta: {
  //   permission: "employee.list",
  // },

  head() {
    return { title: "Data Pegawai" };
  },

  async asyncData(content) {
    let res = (await axios.get("employee")).data;
    let employees = res.data;
    let count = res.count;

    return {
      employees,
      count,
    };
  },

  methods: {
    deleteData(employee) {
      Swal.fire({
        title: "Apakah anda yakin ingin menghapus data ini?",
        text: `${employee.name}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          let res = axios.delete(`employee/${employee.id}`).data;
          Swal.fire("Deleted!", "Data berhasil dihapus.", "success");
        }
      });
      this.$forceUpdate;
    },
  },
};
</script>
