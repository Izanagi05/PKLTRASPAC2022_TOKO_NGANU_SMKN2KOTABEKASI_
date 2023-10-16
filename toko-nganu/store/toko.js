import axios from 'axios'
export const state = () => ({
  alldatatoko: [],
  // editedIndex: -1
  response:null

})

export const mutations= {
  GET_DATA(state, parsdata){
    state.alldatatoko=parsdata
    console.log('p'+parsdata)
  },
  CREATE_DATA(state, adddata){
    state.alldatatoko.push(adddata)
    // console.log(parsdata)
  },
  UPDATE_DATA(state, updtdata){
    const index = state.alldatatoko.findIndex(item => item.toko_id === parseInt(updtdata.toko_id));
    // const index = state.alldatatoko.findIndex(item => item.toko_id === updtdata.toko_id);
    if (index !== -1) {
      const datasementara= state.alldatatoko

      datasementara[index]= updtdata
      state.alldatatoko=[...datasementara]
    }
    console.log(index)
  console.log(updtdata);
  },
  DELETE_DATA(state, id){

    const index = state.alldatatoko.findIndex(item => item.toko_id === id);

    if (index !== -1) {
      // Hapus item dari array
      state.alldatatoko.splice(index, 1);
    }

  }

}
export const getters = {
  getdata: (state)=> state.alldatatoko,
  getresp: (state)=> state.response

}

export const actions ={
  async getdatatoko({commit}, paramId){
    axios
        .get("http://127.0.0.1:8000/api/gettoko/" + paramId)
        .then((respon) => {
      commit('GET_DATA', respon.data?.data)
      // this.barang = respon.data?.data;
    });
  },
  async tambahdata({commit}, newData){
    axios
    .post(
      "http://127.0.0.1:8000/api/createtoko/" + newData.userid,
      newData
    )
    .then((respon) => {
      commit('CREATE_DATA', respon.data?.data)
      // this.$toasted.show("Berhasil hapus keranjang", {
      //   theme: "success",
      //   position: "top-right",
      //   className: "edit-toast",
      //   duration: 3000,
      // });
      this.$router.push("/user-view/toko-user");
      console.log(respon);
    });
  },
  async ubahdata({commit}, updatedata){
    let formData = new FormData();
    formData.append("nama", updatedata.nama);
    formData.append("alamat", updatedata.alamat);
    formData.append("no_telepon", updatedata.no_telepon);
    formData.append("deskripsi", updatedata.deskripsi);
    if (updatedata.fotosementara) {
      formData.append("logo", updatedata.fotosementara);
      console.log('s')
    } else {
      formData.append("logo", updatedata.logo);
      console.log('2')
    }
    axios
      .post(
        "http://127.0.0.1:8000/api/updatetoko/" +
        updatedata.toko_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('UPDATE_DATA', respon.data?.data)
        this.$toast.success("Berhasil update");
        console.log(respon.data);
      });

  },
  async hapusdata({commit}, iddata){
    axios
    .delete(
      "http://127.0.0.1:8000/api/hapustoko/" + iddata
    )
    .then((respon) => {
      commit('DELETE_DATA', iddata)
      console.log(respon);
      // this.getvarian();
      // this.barang
      this.$toast.success("Berhasil hapus");
    });
  }
}


