<template>
  <div>
    <div class="">
      <div class="mb-2">
          <NuxtLink to="/" class="my-2 text-decoration-none black--text">
            Home </NuxtLink
          ><span class="mdi mdi-chevron-right "><b>Profil Pengguna</b></span>
        </div>
        <div
          :class="[
            'font-weight-bold  mb-2',
            $vuetify.breakpoint.smAndDown ? 'text-subtitle-1' : 'text-h6',
          ]"
        >
          Edit Profil
        </div>
      <v-row class="isi my-0 ">
        <v-col cols="12" lg="4" md="4" sm="12" xs="12">

            <div class="  ">

              <div class="d-flex justify-center">
              <v-avatar :size="$vuetify.breakpoint.smAndDown?'100':'200'">
                <img v-if="editprofil.foto_profil" :src="'http://127.0.0.1:8000/storage/' + editprofil.foto_profil
                  " />
              </v-avatar>
              </div>
              <div class="btn-card  pb-1 pt-3 d-flex justify-center mt-2 ">
              <v-btn class=" rounded-lg font-weight-medium " style="width: 80%;"  outlined
                @click="dialog = true">
                Pilih Foto
              </v-btn>
            </div>
            </div>
            <div class="dialog">
              <v-dialog class="rounded-xl" v-model="dialog" width="500px" height="700px">
                <v-card class="rounded-xl">
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
                          <v-btn @click="batalkonfirmfoto" class="rounded-lg " block  outlined>Batal</v-btn>
                        </v-col>
                        <v-col cols="6">
                          <v-btn type="submit" @click="konfirmfoto" class="rounded-lg white--text" block  color="#2f432d">Pilih</v-btn>
                        </v-col>
                      </v-row>
                    </div>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </div>
          </v-col>
          <v-col cols="12" lg="8" md="8" sm="12" xs="12">
            <v-row>
              <v-col cols="12" class="text-h6 font-weight-bold">
                Info Pengguna
              </v-col>
              <v-col cols="12"  class="">
                <v-row class="text-nama pt-5 ">
                  <v-col cols="12" lg="2" class="py-0">Nama</v-col>
                  <v-col cols="12" lg="10" class="py-0">
                    <v-text-field class="rounded-lg "   v-model="editprofil.nama" label="Masukkan Nama"></v-text-field>
                  </v-col>
                </v-row>
                <v-row class="text-nama  ">
                  <v-col cols="12" lg="2" class="py-0">Telepon</v-col>
                  <v-col cols="12" lg="10" class="py-0">
                  <v-text-field class="rounded-lg "  type="number"  v-model="editprofil.no_telepon"
                  label="Masukkan No.Telepon"></v-text-field>
                  </v-col>
                </v-row>
                <v-row class="text-nama  ">
                  <v-col cols="12" lg="2" class="py-0">Email</v-col>
                  <v-col cols="12" lg="10" class="py-0">
                  <v-text-field class="rounded-lg "   v-model="editprofil.email" label="Masukkan Email"></v-text-field>
                </v-col>
              </v-row>
              </v-col>
            </v-row>
            <div class="button pb-6 pt-5">
              <v-row class="justify-end">
                <v-col class="order-2 order-lg-1" cols="12"  lg="4"  md="12" sm="12" xs="12">
                    <v-btn class="rounded-lg " block  outlined @click="backprofil">Batal</v-btn>
                </v-col>
                <v-col class="order-1 order-lg-2 " cols="12" lg="6"  md="12" sm="12" xs="12">
                    <v-btn class="rounded-lg white--text" block  color="#2f432d"
                      @click="updateuser">Simpan</v-btn>
                </v-col>
              </v-row>
            </div>
          </v-col>
        </v-row>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  layout:'UserView',
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


</style>
