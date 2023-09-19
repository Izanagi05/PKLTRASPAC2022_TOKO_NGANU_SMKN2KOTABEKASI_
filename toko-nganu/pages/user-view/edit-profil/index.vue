<template>
  <div>
    <NavbarPolos2 />
    <div class="container">
      <center>
        <div class="judul-page mt-5 mb-2 font-weight-bold" style="font-size: 20px; font-family: 'Poppins', sans-serif">
          Edit Profil
        </div>
        <v-row class="isi">
          <v-col cols="12" lg="6" md="6" sm="12" xs="12">
            <div class="foto-profil pl-5  ">
              <v-avatar style="width:20vw;height: 20vw;">
                <img v-if="editprofil.foto_profil" :src="'http://127.0.0.1:8000/storage/' + editprofil.foto_profil
                  " />
                <!-- {{ editprofil.foto_profil }} -->
              </v-avatar>
              <div class="btn-card  pb-1 pt-3 d-flex justify-center">
              <v-btn class="profil-btn d-flex rounded-pill font-weight-medium "  outlined rounded height="40px"
                @click="dialog = true" style="font-size: 24px; font-family: 'Poppins', sans-serif">
                Pilih Foto
              </v-btn>
            </div>
            </div>
            <div class="dialog">
              <v-dialog v-model="dialog" width="500px" height="700px">
                <v-card>
                  <v-card-text>
                    <div class="preview-foto pt-6">
                      <v-img :src="preview" v-if="preview" width="200px"></v-img>
                    </div>
                    <input accept="image/*" class="file-input pt-6" :rules="rules" type="file" placeholder="Pilih Foto"
                      prepend-icon="mdi-camera" label="Pilih Foto" v-on:change="upload" />
                  </v-card-text>
                  <v-card-actions>
                    <div class="btn-dialog pl-4 pb-4">
                      <v-row>
                        <v-col cols="6">
                          <v-btn @click="batalkonfirmfoto">Batal</v-btn>
                        </v-col>
                        <v-col cols="6">
                          <v-btn type="submit" @click="konfirmfoto">Pilih</v-btn>
                        </v-col>
                      </v-row>
                    </div>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </div>
          </v-col>
          <v-col cols="12" lg="6" md="6" sm="12" xs="12">
            <v-row>
              <v-col cols="2" lg="3" md="3" sm="2" >
                <div class="nama pt-5 pb-5">Nama</div>
                <div class="telepon pb-5">Telepon</div>
                <div class="email pb-5">E-Mail</div>
              </v-col>
              <v-col cols="10" lg="9" md="3" sm="10" class="">
                <div class="text-nama pt-5 pb-5">
                  <v-text-field solo v-model="editprofil.nama" label="Masukkan Nama"></v-text-field>
                </div>
                <div class="text-telepon pb-5">
                  <v-text-field type="number" solo v-model="editprofil.no_telepon"
                    label="Masukkan No.Telepon"></v-text-field>
                </div>
                <div class="text-email pb-5">
                  <v-text-field solo v-model="editprofil.email" label="Masukkan Email"></v-text-field>
                </div>
              </v-col>
            </v-row>
            <div class="button pb-6 pt-5">
              <v-row class="justify-center">
                <v-col class="mr-" cols="12"  lg="4" md="4" sm="4" xs="4">
                  <div class="batal ">
                    <v-btn class="rounded-pill " block x-large outlined @click="backprofil">Batal</v-btn>
                  </div>
                </v-col>
                <v-col cols="12" lg="6" md="6" sm="4" xs="4">
                  <div class="bayar ">
                    <v-btn class="rounded-pill " block  x-large outlined
                      style="background: #2f432d; color: white; size: 105px" @click="updateuser">Simpan</v-btn>
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
  middleware: "middlewareku",
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
      foto: null,
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
            "Foto tidak boleh lebih dari 2 MB!"
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
          this.editprofil = respon.data?.data;
        });
    },
    upload(foto) {
      let files = foto.target.files[0];
      this.datafoto = files;
      let fotobaru = foto.name;
      console.log(files);
      this.preview = URL.createObjectURL(files);
      this.tampungfoto = fotobaru;
    },

    backprofil() {
      this.$router.push("/user-view");
    },

    konfirmfoto() {
      this.dialog = false;
      // this.editprofil.foto_profil = this.foto
    },

    batalkonfirmfoto() {
      this.dialog = false;
      this.datafoto=null
      this.preview=null
      // this.editprofil.foto_profil = this.foto
    },
    updateuser() {
      var formData = new FormData();
      formData.append("nama", this.editprofil.nama);
      // formData.append("alamat", this.editprofil.alamat);
      formData.append("no_telepon", this.editprofil.no_telepon);
      if(this.datafoto){

        console.log("1")
        formData.append("foto_profil", this.datafoto);
      }else{
        console.log("0")
        console.log(this.editprofil.foto_profil)
        // formData.append("foto_profil", this.editprofil.foto_profil);

      }
      formData.append("email", this.editprofil.email);

      axios
        .post(
          "http://127.0.0.1:8000/api/updateuserlogin/" + this.userid,
          formData,
          {
            "content-type": "multipart/form-data",
          }
        )
        .then((respon) => {
          console.log(respon);
          this.$toasted.success('Berhasil update', {
        position: 'top-right',
        className: 'edit-toast',
        duration: 3000
      })
              this.cookie.update('cookieku', respon.data);
          // this.$toast.success("Berhasil diubah");
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
<style scoped>
.edit-toast{
  background: green;
  color:white;
  padding: 10px ;
  border-radius: 20px;
}

/* .btn-card{
  margin:0px 200px;
} */

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
