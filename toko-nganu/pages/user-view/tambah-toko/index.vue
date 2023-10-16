<template>
  <div>
    <div class="pb-5 font-weight-medium text-h6">Tambah Toko</div>
    <div class=" ">
      <div class="">
        <!-- <div class="foto-profil">
          <v-avatar width="170px" height="170px">
            <img src="https://cdn.vuetifyjs.com/images/cards/cooking.png" />
          </v-avatar>
          <h2>Tambah Toko</h2>
        </div> -->
        <v-row>
          <v-col cols="12" lg="3">
            <div class="list">Nama Toko</div>
          </v-col>
          <v-col cols="12" lg="9">
            <v-text-field
              v-model="databarang.nama"
              placeholder="Masukan Nama Untuk Toko"
              solo
              rounded-lg
            ></v-text-field>
          </v-col>
          <v-col cols="12" lg="3">
            <div class="list">Alamat Toko</div>
          </v-col>
          <v-col cols="12" lg="9">
            <v-text-field
              v-model="databarang.alamat"
              placeholder="Masukan Alamat Untuk Toko"
              solo
              rounded-lg
            ></v-text-field>
          </v-col>
          <v-col cols="12" lg="3">
            <div class="list">Deskripsi Toko</div>
          </v-col>
          <v-col cols="12" lg="9">
            <v-text-field
              v-model="databarang.deskripsi"
              placeholder="Masukan Deskripsi Untuk Toko"
              solo
              rounded-lg
            ></v-text-field>
          </v-col>
          <v-col cols="12" lg="3">
            <div class="list">No Telepon</div>
          </v-col>
          <v-col cols="12" lg="9">
            <v-text-field
              v-model="databarang.no_telepon"
              placeholder="Masukan Deskripsi Untuk Toko"
              solo
              rounded-lg
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row class="judul" justify="end">
          <v-col class="order-2 order-lg-1" cols="12"  lg="2"  md="12" sm="12" xs="12">
            <nuxt-link to="/user-view" class="text-decoration-none">
              <v-btn
                rounded-lg
                block
                outlined
                class=" text-capitalize"
              >
                Batal
              </v-btn>
            </nuxt-link>
          </v-col>
          <v-col class="order-1 order-lg-2" cols="12"  lg="3"  md="12" sm="12" xs="12">
            <v-btn
              rounded-lg
              block
              color="#2f432d"
              class=" white--text text-capitalize"
              @click="buattoko()"
              >buat</v-btn
            >
          </v-col>
        </v-row>
      </div>
    </div>
  </div>
</template>

<style scoped>
.edit-toast {
  background: green;
  color: white;
  padding: 10px;
  border-radius: 20px;
}

.foto-profil {
  margin-bottom: 20px;
}
/* .tambah-container {
  padding: 0px 400px;
} */
/* .dalam-container {
  padding: 50px 50px;
  border-radius: 2%;
  color: rgb(0, 0, 0);
  background: #ffffff;
} */
.panel {
  margin-bottom: 20px;
}
/* .button-aksi {
  color: rgb(255, 255, 255) !important;
  background: #2f432d;
} */
</style>

<script>
import axios from "axios";
import { mapActions, mapState, mapGetters } from "vuex";
export default {
  layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      panel: [0, 1, 2, 3],
      databarang: {
        userid: null,
        nama: null,
        alamat: null,
        deskripsi: null,
        no_telepon: null,
        logo: null,
      },
    };
  },

  methods: {
    ...mapActions(["tambahdata"]),
    buattoko() {
      this.databarang.userid = this.userid;

      this.$store.dispatch("toko/tambahdata", this.databarang);
      console.log("tes");
    },
    // upload(foto) {
    //   let files = foto.target.files[0];
    //   this.preview = URL.createObjectURL(files);
    //   this.photo = files;
    // },
    // buattoko() {
    //   axios
    //     .post(
    //       "http://127.0.0.1:8000/api/createtoko/" + this.userid,
    //       this.databarang
    //     )
    //     .then((respon) => {
    //       this.$router.push("/user-view/toko-user");
    //       console.log(respon);
    //     });
    //   // let formData = new FormData()
    //   // formData.append('logo', this.photo)
    //   //   axios.post('http://127.0.0.1:8000/api/createtoko/'+ this.userid, formData, {
    //   //         'content-type': 'multipart/form-data'
    //   //       })
    // },
    backprofil() {
      this.$router.push("/user-view");
    },
  },
  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
  },
};
</script>
