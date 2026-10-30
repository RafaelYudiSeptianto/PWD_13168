function fn_ValForm() {
    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umurInput = document.getElementById("umur").value.trim();
    var paket = document.getElementById("kategori").value;
    var errors = [];
    var emailPattern = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;
    var umur;
    var info;
    var pilihan;

    if (nama === "") {
        errors.push("Nama tidak boleh kosong.");
    }

    if (email === "") {
        errors.push("Email tidak boleh kosong.");
    } else if (!emailPattern.test(email)) {
        errors.push("Email tidak valid. Gunakan huruf kecil dan format yang benar.");
    }

    if (umurInput === "") {
        errors.push("Umur tidak boleh kosong.");
    } else {
        umur = Number(umurInput);
        if (!isFinite(umur) || umur < 17 || umur > 65) {
            errors.push("Umur harus berupa angka antara 17 sampai 65 tahun.");
        }
    }

    if (paket === "") {
        errors.push("Paket member tidak boleh kosong.");
    } else if (paket !== "S" && paket !== "G" && paket !== "P") {
        errors.push("Paket member tidak valid.");
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }

    if (umur <= 25) {
        info = "Paket Pelajar";
    } else {
        info = "Paket Umum";
    }

    switch (paket) {
        case "S":
            pilihan = "Silver";
            break;
        case "G":
            pilihan = "Gold";
            break;
        case "P":
            pilihan = "Platinum";
            break;
    }

    alert("Terima kasih " + nama + " ! Anda terdaftar di paket " + pilihan + " (" + info + ").");
    return true;
}
