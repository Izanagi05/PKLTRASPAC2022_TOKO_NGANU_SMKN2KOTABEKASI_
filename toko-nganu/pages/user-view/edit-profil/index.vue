<template>
  <div>
    <NavbarPolos2 />
    <div class="profil">
      <center>
        <div
          class="judul-page mt-5 mb-2 font-weight-bold"
          style="font-size: 20px; font-family: 'Poppins', sans-serif"
        >
          Edit Profil
        </div>
        <v-row class="isi">
          <v-col cols="6">
            <div class="foto-profil pl-5">
              <v-avatar width="270px" height="270px">
                <v-img :src="require('~/assets/barang.png')"></v-img>
              </v-avatar>
            </div>
            <div class="btn-card pl-1 pb-1 pt-3">
              <v-btn
                class="profil-btn rounded-pill font-weight-medium"
                width="310px"
                @click="dialog = true"
                style="font-size: 24px; font-family: 'Poppins', sans-serif"
              >
                Pilih Foto
              </v-btn>
            </div>
            <div class="dialog">
              <v-dialog v-model="dialog" width="500px" height="700px">
                <v-card>
                  <v-card-text>
                    <div class="preview-foto pt-6">
                      <v-img
                        :src="preview"
                        v-if="preview"
                        width="200px"
                      ></v-img>
                    </div>
                    <v-file-input
                      class="file-input pt-6"
                      :rules="rules"
                      accept="image/png, image/jpeg, image/bmp"
                      placeholder="Pilih Foto"
                      prepend-icon="mdi-camera"
                      label="Pilih Foto"
                      v-on:change="upload"
                    ></v-file-input>
                  </v-card-text>
                  <v-form>
                    <v-card-actions>
                      <div class="btn-dialog pl-4 pb-4">
                        <v-row>
                          <v-col cols="6">
                            <v-btn @click="dialog = false">Batal</v-btn>
                          </v-col>
                          <v-col cols="6">
                            <v-btn type="submit">Pilih</v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-actions>
                  </v-form>
                </v-card>
              </v-dialog>
            </div>
          </v-col>
          <v-col cols="6">
            <v-row>
              <v-col cols="12" sm="3">
                <div class="nama pt-5 pb-5">Nama</div>
                <div class="alamat pb-5">Alamat</div>
                <div class="telepon pb-5">Telepon</div>
                <div class="email pb-5">E-Mail</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div class="text-nama pt-5 pb-5">
                  <v-text-field
                    solo
                    v-model="editprofil.nama"
                    label="Masukkan Nama"
                  ></v-text-field>
                </div>
                <div class="text-alamat pb-5">
                  <v-textarea
                    solo
                    v-model="editprofil.alamat"
                    label="Masukkan Alamat"
                  ></v-textarea>
                </div>
                <div class="text-telepon pb-5">
                  <v-text-field
                    type="number"
                    solo
                    v-model="editprofil.no_telepon"
                    label="Masukkan No.Telepon"
                  ></v-text-field>
                </div>
                <div class="text-email pb-5">
                  <v-text-field
                    solo
                    v-model="editprofil.email"
                    label="Masukkan Email"
                  ></v-text-field>
                </div>
              </v-col>
            </v-row>
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
                  <div class="bayar">
                    <v-btn
                      class="rounded-pill"
                      width="307px"
                      x-large
                      outlined
                      style="background: #2f432d; color: white; size: 105px"
                      @click="updateuser"
                      >Simpan</v-btn
                    >
                  </div>
                </v-col>
              </v-row>
            </div>
          </v-col>
        </v-row>
      </center>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      olddata: null,
      editprofil: {
        nama: null,
        alamat: null,
        no_telepon: null,
        email: null,
      },
      userid: null,
      dialog: false,
      preview: "",
      rules: [
        (value) => {
          return (
            !value ||
            !value.length ||
            value[0].size < 2000000 ||
            "Avatar size should be less than 2 MB!"
          );
        },
      ],
    };
  },
  methods: {
    getuserlogin() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.editprofil = respon.data;
        });
    },
    updateuser() {
      axios
        .post(
          "http://127.0.0.1:8000/api/updateuserlogin/" + this.userid,
          this.editprofil
        )
        .then((respon) => {
          console.log(respon);
        });
      this.$router.push("/user-view");
    },
    backprofil() {
      this.$router.push("/user-view");
    },
    upload(foto) {
      const fotobaru = foto.name;
      this.editprofil.fotoprofil = fotobaru;
      this.preview = URL.createObjectURL(foto);
    },
  },
  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getuserlogin();
  },
};
</script>
<style>
.profil-btn:hover {
  background: #2f432d;
  color: rgb(255, 255, 255);
}
.nama {
  margin-top: 10px;
  margin-bottom: 57px;
}
.alamat {
  margin-bottom: 150px;
}
.telepon {
  margin-bottom: 57px;
}
</style>
