interface CommitteeMember {
    id: number;
    name: string;
    leader: string;
    description: string;
    image: string;
    imageBackground: string;
    instagram?: string;
    staff?: string[];
}

const committees: CommitteeMember[] = [
    {
        id: 1,
        name: 'Ketua Himpunan',
        leader: 'Muhammad Ilham Rafiqi',
        description: 'Memimpin dan mengkoordinasikan seluruh kegiatan organisasi HMIF Unsoed dengan visi dan misi yang jelas.',
        image: '/img/committees/kahim.png',
        imageBackground: '/img/backgrounds/divisi-bph.png',
        instagram: 'rafiqiilham',
        staff: ['Staff 1', 'Staff 2', 'Staff 3', 'Staff 4', 'Staff 5'],
    },
    {
        id: 2,
        name: 'Wakil Ketua Himpunan',
        leader: 'Wakil Ketua Himpunan',
        description: 'Mendampingi ketua umum dalam menjalankan tugas dan tanggung jawab organisasi.',
        image: '/img/committees/wakahim.png',
        imageBackground: '/img/backgrounds/divisi-bph.png',
        instagram: 'rvalinafa_',
        staff: ['Staff 1', 'Staff 2', 'Staff 3', 'Staff 4', 'Staff 5'],
    },
    {
        id: 3,
        name: 'Sekretaris',
        leader: 'Ayu Fitrianingsih',
        description: 'Mengelola administrasi dan dokumentasi organisasi dengan rapi dan terstruktur.',
        image: '/img/committees/koor-sekretaris.png',
        imageBackground: '/img/backgrounds/divisi-bph.png',
        instagram: '_ayfitriann',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 4,
        name: 'Bendahara',
        leader: 'Fina Julianti',
        description: 'Mengelola keuangan organisasi dengan transparan dan akuntabel.',
        image: '/img/committees/koor-bendahara.png',
        imageBackground: '/img/backgrounds/divisi-bph.png',
        instagram: 'fiinnnaaaav',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 5,
        name: 'Medkominfo',
        leader: 'Nadzare Kafah Alfatiha',
        description: 'Mengelola media dan informasi organisasi dengan efektif dan inovatif.',
        image: '/img/committees/koor-medkominfo.png',
        imageBackground: '/img/backgrounds/divisi-medkominfo.png',
        instagram: 'nadzarekafaha',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 6,
        name: 'Minat dan Bakat',
        leader: 'Rafif Surya Murtadha',
        description:
            'Mendorong pengembangan potensi individu melalui kegiatan seni, olahraga, dan kompetisi yang membangun semangat serta kreativitas anggota.',
        image: '/img/committees/koor-mikat.png',
        imageBackground: '/img/backgrounds/divisi-mikat.jpg',
        instagram: 'rafifsurya_',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 7,
        name: 'Pengembangan Sumber Daya Mahasiswa',
        leader: 'Tsaqif Hasbi Aghna Syarief',
        description:
            'Meningkatkan kapasitas dan kualitas anggota melalui pelatihan soft skill, leadership, dan pengembangan karakter yang berkelanjutan.',
        image: '/img/committees/koor-psdm.png',
        imageBackground: '/img/backgrounds/divisi-psdm.jpg',
        instagram: 'tsaqifhsb_',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 8,
        name: 'Keilmuan dan Teknologi',
        leader: 'Athallah Tsany Satriyaji',
        description: 'Mendorong eksplorasi dan penerapan ilmu pengetahuan serta teknologi melalui riset, workshop, dan pengembangan inovasi digital.',
        image: '/img/committees/koor-iltek.png',
        imageBackground: '/img/backgrounds/divisi-iltek.jpg',
        instagram: 'ath_tsany',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 9,
        name: 'Edukasi',
        leader: 'Dwi Bagus Purwo Aji',
        description:
            'Meningkatkan literasi dan semangat belajar anggota melalui program edukatif seperti kelas belajar, diskusi, dan mentoring akademik.',
        image: '/img/committees/koor-edu.png',
        imageBackground: '/img/backgrounds/divisi-edu.jpg',
        instagram: 'zerive05',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 10,
        name: 'Kreasi dan Usaha',
        leader: 'Mukhammad Alfaen Fadillah',
        description: 'Mendorong jiwa kewirausahaan dan kreativitas anggota melalui pengembangan produk, bisnis, dan kegiatan ekonomi kreatif.',
        image: '/img/committees/koor-kreus.png',
        imageBackground: '/img/backgrounds/divisi-kreus.jpg',
        instagram: 'alpaenf_',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
    {
        id: 11,
        name: 'Hubungan Masyarakat',
        leader: 'Dyah Ghaniya Putri',
        description:
            'Menjalin komunikasi dan relasi positif antara organisasi dengan pihak eksternal serta membangun citra organisasi yang profesional.',
        image: '/img/committees/koor-humas.png',
        imageBackground: '/img/backgrounds/divisi-humas.jpg',
        instagram: 'dyahgputri',
        staff: ['Staff A', 'Staff B', 'Staff C'],
    },
];

export default committees;
