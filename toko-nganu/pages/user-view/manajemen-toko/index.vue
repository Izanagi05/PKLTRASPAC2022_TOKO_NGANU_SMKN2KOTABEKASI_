<template>
  <div>
    <v-dialog v-model="dialogstatus">
      <v-card class="pa-4">
        <v-text-field
          v-model="editeddetaildatadialog.status"
          label="set status"
        ></v-text-field>
        <v-btn class="rounded-lg px-8" outlined @click="closeedit">Close</v-btn>
        <v-btn
          class="rounded-lg ml-8 px-8 white--text"
          color="#4caf50"
          @click="konfirmstatus"
          >Ubah</v-btn
        >
      </v-card>
    </v-dialog>
    <DialogDelete
      :dialogDelete="dialogDelete"
      :confirmhapus="confirmhapustransaksi"
      :closeDelete="closeDelete"
    />
    <div
      :class="[
        'font-weight-bold  mb-2',
        $vuetify.breakpoint.smAndDown ? 'text-subtitle-1' : 'text-h6',
      ]"
    >
      Toko Pengguna
    </div>
    <div class="d-flex overflow-x-auto mt-4">
      <v-card
        width="600px"
        outlined
        class="text-h6 mb-1 pa-2 mx-3"
        v-for="(tk, i) in Toko"
        :key="i"
        @click="tampiltransakasi(tk)"
      >
        <div class="image-container3 d-flex justify-center align-center">
          <img
            object-fit="cover"
            class="rounded-lg"
            width="80%"
            height="80%"
            :src="'http://127.0.0.1:8000/storage/' + tk.logo"
            alt=""
            srcset=""
          />
        </div>
        <div class="text-body-1 font-weight-medium">
          {{ tk.nama }}
        </div>
      </v-card>
    </div>
    <div class="mt-4">
      <v-data-table :headers="headers" :items="alldatatransakasi">
        <template v-slot:[`item.aksistatus`]="{ item }">
          <div>
            <v-chip
              @click="editstatus(item)"
              :class="statuscolor(item).textClass"
              :color="statuscolor(item).bgColor"
            >
              {{ item.status }}
            </v-chip>
          </div>
        </template>
        <template v-slot:[`item.total_harga`]="{ item }">
          <div>Rp. {{ item.total_harga }}</div>
        </template>
        <template v-slot:[`item.aksikonfirm`]="{ item }">
          <div>
            <v-btn
              icon
              small
              color="#4caf50"
              @click="setYaTidak('Ya', item)"
              :disabled="item.admin_konfirmasi === 'Ya' ? true : false"
              ><v-icon>mdi-check</v-icon></v-btn
            >
            <v-btn
              icon
              small
              color="#ff5252"
              @click="setYaTidak('Tidak', item)"
              :disabled="
                item.admin_konfirmasi === 'Ya' ||
                item.admin_konfirmasi === 'Tidak'
                  ? true
                  : false
              "
              ><v-icon>mdi-close</v-icon></v-btn
            >
          </div>
        </template>
        <template v-slot:[`item.aksidelete`]="{ item }">
          <div>
            <v-btn icon small color="#ff5252" @click="deleteTransaksi(item)"
              ><v-icon>mdi-trash-can-outline</v-icon></v-btn
            >
          </div>
        </template>
      </v-data-table>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  layout: "UserView",
  data() {
    return {
      headers: [
        { text: "User ", value: "nama_pengguna" },
        { text: "Toko ", value: "nama_toko" },
        { text: "Kategori ", value: "nama_kategori" },
        { text: "Varian ", value: "nama_varian" },
        { text: "Barang ", value: "nama_barang" },
        // { text: "status ", value: "status" },
        { text: "setstatus ", value: "aksistatus" },
        { text: "Jumlah ", value: "jumlah" },
        { text: "Total harga ", value: "total_harga" },
        { text: "konfirmasi ", value: "admin_konfirmasi" },
        { text: "setkonfirmasi ", value: "aksikonfirm" },
        { text: "Hapus ", value: "aksidelete" },
        // { text: "Aksi", value: "aksi" },
      ],
      // datastatus: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      defaultItem: {
        transaksi_id: null,
        user_id: null,
        toko_id: null,
        barang_id: null,
        kategori_id: null,
        varian_id: null,
        admin_konfirmasi: null,
        status: null,
        jumlah: null,
        metode_bayar: null,
        total_harga: null,
      },
      tokoid: null,
      dialogDelete: false,

      alldatatransakasi: [],
      detaildatadialog: {
        status: null,
      },
      editeddetaildatadialog: {
        status: null,
      },
      dialogstatus: false,
      dialogsetkonfirm: false,
      psetyatidak: null,
    };
  },
  computed: {
    Toko() {
      return this.$store.state.toko.alldatatoko;
    },
    // ...mapGetters('toko', ['getdata','getresp']),
  },

  methods: {
    getdatatransaksi() {
      axios
        .get("http://localhost:8000/api/getdatatransakasibytoko/" + this.tokoid)
        .then((respon) => {
          this.alldatatransakasi = respon.data?.data;
        });
    },
    tampiltransakasi(idtoko) {
      this.tokoid = idtoko.toko_id;
      this.getdatatransaksi();
    },
    editstatus(item) {
      this.detaildatadialog = item;
      this.editeddetaildatadialog.status = item.status;
      console.log(item);
      this.dialogstatus = true;
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    deleteTransaksi(item) {
      (this.dialogDelete = true), (this.detaildatadialog = item);
    },
    confirmhapustransaksi() {
      axios
        .delete(
          "http://localhost:8000/api/deletetransaksi/" +
            this.detaildatadialog.transaksi_id
        )
        .then((respon) => {
          console.log(respon.data);
          this.closeDelete();
          this.getdatatransaksi();
        });
    },
    closeedit() {
      // this.detaildatadialog = null;
      this.$nextTick(() => {
        this.editeddetaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogstatus = false;
    },
    konfirmstatus() {
      this.detaildatadialog.status = this.editeddetaildatadialog.status;
      axios
        .post(
          "http://localhost:8000/api/updatetransaksi/" +
            this.detaildatadialog.transaksi_id,
          this.detaildatadialog
        )
        .then((respon) => {
          this.getdatatransaksi();
        });
      this.dialogstatus = false;
    },
    setYaTidak(konfirm, item) {
      this.detaildatadialog = item;
      this.detaildatadialog.admin_konfirmasi = konfirm;
      axios
        .post(
          "http://localhost:8000/api/updatetransaksi/" +
            this.detaildatadialog.transaksi_id,
          this.detaildatadialog
        )
        .then((respon) => {
          this.getdatatransaksi();
        });
    },
    statuscolor(item) {
      if (item.admin_konfirmasi === "Ya") {
        return {
          bgColor: "#E8F5E9",
          textClass: "green--text",
        };
      } else if (item.admin_konfirmasi === "Tidak") {
        return {
          bgColor: "#FFEBEE",
          textClass: "red--text",
        };
      } else {
        return {
          bgColor: "#FFF3E0",
          textClass: "orange--text",
        };
      }
    },
  },
  created() {
    const userid = this.$cookies.get("cookieku");
    this.tokouser = userid.data.id;
    this.$store.dispatch("toko/getdatatoko", this.tokouser);
    this.getdatatransaksi();
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
</style>
