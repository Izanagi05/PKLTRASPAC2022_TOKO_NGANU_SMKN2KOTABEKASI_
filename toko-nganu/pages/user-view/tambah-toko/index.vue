<template>
  <div>
    <NavbarPolos2 />
    <div class="card">
      <center>
        <v-card
          flat
          max-width="400"
          max-height="950"
          variant="outlined"
          style="margin-top: 100px"
        >
          <v-card flat>
            <div>
              <div
                class="judul text-h3 font-weight-bold pb-4"
                style="font-family: 'Poppins', sans-serif"
              >
                Tambah Toko
              </div>
            </div>
            <v-sheet width="300">
              <v-form>
                <v-text-field
                  v-model="databarang.nama"
                  placeholder="Nama"
                ></v-text-field>
                <v-text-field
                  v-model="databarang.alamat"
                  placeholder="Alamat"
                ></v-text-field>
                <v-text-field
                  v-model="databarang.deskripsi"
                  placeholder="Deskripsi"
                ></v-text-field>
                <v-text-field
                  v-model="databarang.no_telepon"
                  placeholder="No Telepon"
                ></v-text-field>
                <v-text-field
                  v-model="databarang.logo"
                  placeholder="logo"
                ></v-text-field>
                <div class="button pb-6 pt-5">
                  <v-row>
                    <v-col cols="4">
                      <div class="batal">
                        <v-btn
                          class="rounded-pill"
                          x-large
                          outlined
                          @click="backprofil"
                          >Batal</v-btn
                        >
                      </div>
                    </v-col>
                    <v-col cols="6">
                      <div class="tambah-toko">
                        <v-btn
                          class="rounded-pill"
                          width="207px"
                          x-large
                          outlined
                          style="background: #2f432d; color: white; size: 105px"
                          @click="buattoko()"
                          >Simpan</v-btn
                        >
                      </div>
                    </v-col>
                  </v-row>
                </div>
              </v-form>
            </v-sheet>
          </v-card>
        </v-card>
      </center>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
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
    upload(foto) {
      let files = foto.target.files[0];
      this.preview = URL.createObjectURL(files);
      this.photo = files;
    },
    buattoko() {
      axios
        .post(
          "http://127.0.0.1:8000/api/createtoko/" + this.userid,
          this.databarang
        )
        .then((respon) => {
          this.$router.push("/user-view/toko-user");
          console.log(respon);
        });
      // let formData = new FormData()
      // formData.append('logo', this.photo)
      //   axios.post('http://127.0.0.1:8000/api/createtoko/'+ this.userid, formData, {
      //         'content-type': 'multipart/form-data'
      //       })
    },
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
