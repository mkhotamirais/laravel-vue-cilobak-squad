export function formatTanggal(tanggalString) {
    const bulanIndonesia = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];

    const tanggal = new Date(tanggalString);
    const hari = tanggal.getDate();
    const bulan = bulanIndonesia[tanggal.getMonth()];
    const tahun = tanggal.getFullYear();

    const jam = String(tanggal.getHours()).padStart(2, "0");
    const menit = String(tanggal.getMinutes()).padStart(2, "0");

    return `${hari} ${bulan} ${tahun} - ${jam}:${menit}`;
}

export const institusi = [
    { value: "ptiq_h", label: "PTIQ H" },
    { value: "pku_b", label: "PKU B" },
    { value: "pku_p", label: "PKU P" },
    { value: "ptiq_g", label: "PTIQ G" },
];
