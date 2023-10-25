<template>
  <div>
    <DialogDelete
      :dialogDelete="dialogDelete"
      :confirmhapus="confirmhapustoko"
      :closeDelete="closeDelete"
    />
    <DialogUpdate
      :dialogedit="dialogedit"
      item="Toko"
      :detaildatadialog="detaildatadialog"
      :upload="upload"
      :closeedit="closeedit"
      :updateedit="updatetoko"
    />
    <div class="pb-5 font-weight-medium text-h6">Detail Toko</div>
    <div>
      <div class="button-add pl-4 pb-6">
        <nuxt-link class="text-decoration-none" to="/user-view/tambah-barang"
          ><v-btn
            class="text-capitalize px-8 text-body-1 font-weight-medium rounded-lg white--text"
            color="#2f432d"
            >Tambah barang</v-btn
          ></nuxt-link
        >
      </div>
      <div  style="height: 80vh; overflow-y: scroll;" class="rounded-lg">
      <v-data-table data-app :headers="headers" :items="Toko" class="">
        <template v-slot:[`item.logo`]="{ item }">
          <div class="image-container3 d-flex justify-center align-center">
            <img
              object-fit="cover"
              class="rounded-lg"
              width="80%"
              height="80%"
              :src="'http://127.0.0.1:8000/storage/' + item.logo"
            />
          </div>
        </template>
        <template v-slot:[`item.detail`]="{ item }">
          <v-btn
            class="mx-2 rounded-lg"
            small
            @click="detailbarang(item)"
            style="margin: 15px 15px 15px 0px"
          >
            Detail barang
          </v-btn>
        </template>
        <template v-slot:[`item.aksi`]="{ item }">
          <div class="d-flex">
            <v-btn
              class="mx-2"
              icon
              color="#4caf50"
              small
              @click="ubahdata(item)"
            >
              <v-icon >mdi-pencil</v-icon>
            </v-btn>
            <v-btn
              class="mx-2 "
              icon
              color="#ff5252"
              small
              @click="hapustoko(item)"
            >
              <v-icon >mdi-delete</v-icon>
            </v-btn>
          </div>
        </template>
        <template v-slot:[`item.nomor`]="{ index }">
          <div>
            {{ index + 1 }}
          </div>
        </template>
      </v-data-table>
    </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions, mapState, mapGetters } from "vuex";
export default {
  // layout: "UserView",
  layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      dialogDelete: false,
      dialogedit: true,
      datafoto: null,
      cari: null,
      nama: null,
      tokouser: null,
      // Toko: [],
      UbahToko: null,
      edittokoid: null,
      tess: 18,

      datatoko: [],
      dialogdetail: false,
      dialogedit: false,
      indexnya: null,
      headers: [
        //  {text: 'Id Toko', align: 'start', value: 'toko_id'},
        { text: "Logo", align: "start", value: "logo" },
        { text: "Nama Toko", align: "start", value: "nama" },
        { text: "Alamat", align: "start", value: "alamat" },
        { text: "NO Telepon", align: "start", value: "no_telepon" },
        { text: "Deskripsi", align: "start", value: "deskripsi" },
        { text: "Detail", align: "start", value: "detail" },
        { text: "Aksi", align: "start", value: "aksi" },
      ],
      dialoghapus: false,

      //  detaildatadialog: [],
      detaildatadialog: {
        toko_id: "",
        fotosementara: "",
        nama: "",
        alamat: "",
        no_telepon: "",
        deskripsi: "",
        logo: "",
        barang: "",
      },
      defaultItem: {
        toko_id: "",
        fotosementara: "",
        nama: "",
        alamat: "",
        no_telepon: "",
        deskripsi: "",
        logo: "",
      },
    };
  },
  computed: {
    Toko() {
      return this.$store.state.toko.alldatatoko;
    },
    // ...mapGetters('toko', ['getdata','getresp']),
  },
  methods: {
    // ...mapActions(['getdatatoko', 'hapusdata']),
    gettoko() {
      // axios
      //   .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
      //   .then((respon) => {
      //     this.Toko = respon.data?.data;
      //     // this.edittokoid = respon.data?.data.toko_id;
      //   });
    },
    klikdetail(item) {
      this.detaildatadialog = Object.assign({}, item);
      this.dialogdetail = true;
    },
    detailbarang(item) {
      this.$router.push(`/user-view/toko-user/detailtoko/${item.toko_id}`);
    },
    closedetail() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogdetail = false;
    },

    ubahdata(item) {
      this.indexnya = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogedit = true;
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogedit = false;
    },
    upload(foto) {
      let files = foto.target.files[0];
      this.detaildatadialog.fotosementara = files;
      console.log(foto);
    },
    updatetoko() {
      // let formData = new FormData();
      // formData.append("nama", this.detaildatadialog.nama);
      // formData.append("alamat", this.detaildatadialog.alamat);
      // formData.append("no_telepon", this.detaildatadialog.no_telepon);
      // formData.append("deskripsi", this.detaildatadialog.deskripsi);
      // if (this.datafoto) {
      //   formData.append("logo", this.datafoto);
      //   console.log('s')
      // } else {
      //   formData.append("logo", this.detaildatadialog.logo);
      //   console.log('2')
      // }
      // axios
      //   .post(
      //     "http://127.0.0.1:8000/api/updatetoko/" +
      //       this.detaildatadialog.toko_id,
      //     formData,
      //     {
      //       "content-type": "multipart/form-data",
      //     }
      //   )
      //   .then((respon) => {
      //     this.$toast.success("Berhasil update");
      //     console.log(respon.data);
      //   });
      //   this.gettoko();

      // Object.assign(this.Toko[this.indexnya], this.detaildatadialog);
      this.$store.dispatch("toko/ubahdata", this.detaildatadialog);
      this.dialogedit = false;
    },

    hapustoko(item) {
      this.editedIndex = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapustoko() {
      // axios
      //   .delete(
      //     "http://127.0.0.1:8000/api/hapustoko/" + this.detaildatadialog.toko_id
      //   )
      //   .then((respon) => {
      //     console.log(respon);
      //     this.$toast.success("Berhasil hapus");
      //   });
      // this.Toko.splice(this.editedIndex, 1);
      // this.gettoko();
      this.$store.dispatch("toko/hapusdata", this.detaildatadialog.toko_id);
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },

  mounted() {
    // this.gettoko();
    //  this.gettoko();
  },

  created() {
    const userid = this.$cookies.get("cookieku");
    this.tokouser = userid.data.id;
    this.$store.dispatch("toko/getdatatoko", this.tokouser);
    // this.gettoko();
  },
};
</script>
<style scoped>
.image-container3 {
  width: 100px;
  height: 100px;
  overflow: hidden;
}

.image-container3 img {
  object-fit: cover;
  object-position: center;
}
.edit-toast {
  background: green;
  color: white;
  padding: 10px;
  border-radius: 20px;
}
</style>
