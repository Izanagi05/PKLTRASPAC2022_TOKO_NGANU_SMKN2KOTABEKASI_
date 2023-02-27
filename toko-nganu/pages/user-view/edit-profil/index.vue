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
                <img v-if="editprofil.foto_profil" :src="'http://127.0.0.1:8000/storage/'+editprofil.foto_profil"/>
                <!-- {{ editprofil.foto_profil }} -->
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
                    <input
                      class="file-input pt-6"
                      :rules="rules"
                      type="file"
                      placeholder="Pilih Foto"
                      prepend-icon="mdi-camera"
                      label="Pilih Foto"
                      v-on:change="upload"
                    />
                  </v-card-text>
                    <v-card-actions>
                      <div class="btn-dialog pl-4 pb-4">
                        <v-row>
                          <v-col cols="6">
                            <v-btn @click="dialog = false">Batal</v-btn>
                          </v-col>
                          <v-col cols="6">
                            <v-btn type="submit" @click="konfirmfoto" >Pilih</v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-actions>
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
        foto_profil: null,
        email: null,
      },
      foto:null,
      userid: null,
      dialog: false,
      preview: null,
      datafoto: null,
      tampungfoto: null,
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
    upload(foto) {
    let files = foto.target.files[0];
    this.datafoto = files;
    let fotobaru = foto.name;
    console.log(files)
    this.preview = URL.createObjectURL(files);
    this.tampungfoto = fotobaru;
  },

    backprofil() {
      this.$router.push("/user-view");
    },

    konfirmfoto(){
      this.dialog=false;
      // this.editprofil.foto_profil = this.foto
    },
    updateuser() {
      let formData = new FormData()
    formData.append('foto_profil', this.datafoto)
//       const json = JSON.stringify({
//     nama: this.editprofil.nama,
//     no_telepon: this.editprofil.no_telepon,
//     email: this.editprofil.email,
// });

  //  formData.append('User',json)
      // this.editprofil.foto_profil = tes;
      // console.log(this.editprofil.foto_profil)
      axios
        .post(
          "http://127.0.0.1:8000/api/updateuserlogin/" + this.userid, formData, {
            'content-type': 'multipart/form-data'
          }
        )
        // 'Content-Type': 'multipart/form-data;  charset=utf-8; boundary='+ Math.random().toString().substr(2)
        .then((respon) => {
          console.log(respon);
        });
      axios
        .post(
          "http://127.0.0.1:8000/api/updateuserlogin/" + this.userid, this.editprofil, {
            'content-type': 'multipart/form-data'
          }
        )
        // 'Content-Type': 'multipart/form-data;  charset=utf-8; boundary='+ Math.random().toString().substr(2)
        .then((respon) => {
          console.log(respon);
        });
      this.$router.push("/user-view");
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
