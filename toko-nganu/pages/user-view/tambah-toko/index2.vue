<template>
  <div>
    <div class="pb-5 font-weight-medium">Tambah Toko</div>
    <div class="text-center justify-center tambah-container">
      <div class="dalam-container">
        <div class="foto-profil">
          <v-avatar width="170px" height="170px">
            <img src="https://cdn.vuetifyjs.com/images/cards/cooking.png" />
          </v-avatar>
          <h2>Tambah Toko</h2>
        </div>
        <v-expansion-panels >
          <v-expansion-panel class="panel rounded-xl">
            <v-expansion-panel-header>
              <template v-slot:default="{ open }">
                <v-row no-gutters>
                  <v-col cols="4"> Nama </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> Nama Toko mu</span>
                      <span v-else>
                        {{ databarang.nama }}
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </template>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-text-field
                v-model="databarang.nama"
                placeholder="Masukan Nama Untuk Toko"
                outlined
                rounded
              ></v-text-field>
            </v-expansion-panel-content>
          </v-expansion-panel>
          <v-expansion-panel class="panel rounded-xl" >
            <v-expansion-panel-header>
              <template v-slot:default="{ open }">
                <v-row no-gutters>
                  <v-col cols="4"> Alamat </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> Alamat Toko mu</span>
                      <span v-else>
                        {{ databarang.alamat }}
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </template>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-text-field
                v-model="databarang.alamat"
                placeholder="Masukan Alamat Untuk Toko"
                outlined
                rounded
              ></v-text-field>
            </v-expansion-panel-content>
          </v-expansion-panel>
          <v-expansion-panel class="panel rounded-xl">
            <v-expansion-panel-header>
              <template v-slot:default="{ open }">
                <v-row no-gutters>
                  <v-col cols="4"> No.Telp </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> No.Telp Toko Mu</span>
                      <span v-else>
                        {{ databarang.no_telepon }}
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </template>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-text-field
                v-model="databarang.no_telepon"
                placeholder="Nomor Telepon Toko"
                outlined
                rounded
              ></v-text-field>
            </v-expansion-panel-content>
          </v-expansion-panel>

          <v-expansion-panel class="panel rounded-xl">
            <v-expansion-panel-header>
              <template v-slot:default="{ open }">
                <v-row no-gutters>
                  <v-col cols="4"> Deskripsi </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> Deskripsi Toko</span>
                      <span v-else>
                        {{ databarang.deskripsi }}
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </template>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-text-field
                v-model="databarang.deskripsi"
                placeholder="Masukan Deskripsi Untuk Toko"
                outlined
                rounded
              ></v-text-field>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <v-btn
          rounded
          outlined
          width="150px"
          class="button-aksi"
          @click="buattoko()"
          >buat</v-btn
        >
      </div>
    </div>
  </div>
</template>

<style scoped>
.edit-toast{
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
.dalam-container {
  padding: 50px 50px;
  border-radius: 2%;
  color: rgb(0, 0, 0);
  background: #ffffff;
}
.panel {
  margin-bottom: 20px;
}
.button-aksi {
  color: rgb(255, 255, 255) !important;
  background: #2f432d;
}
</style>

<script>
import axios from "axios";
import { mapActions, mapState, mapGetters } from 'vuex';
export default {
  layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      panel:[0,1,2,3],
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
    ...mapActions(['tambahdata']),
    buattoko() {
      this.databarang.userid=this.userid

        this.$store.dispatch('toko/tambahdata', this.databarang )
        console.log("tes")
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
