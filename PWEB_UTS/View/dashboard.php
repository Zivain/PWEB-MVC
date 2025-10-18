<?php

$username = $_SESSION['username'] ?? '';
$role     = $_SESSION['role'] ?? '';

// Pastikan list selalu array asosiatif
if(!isset($_SESSION['list']) || !is_array($_SESSION['list'])){
    $_SESSION['list'] = [
        ['id'=>1, 'nama'=>'Item 1'],
        ['id'=>2, 'nama'=>'Item 2']
    ];
}

// Tambah item baru jika role Admin
if($role === 'Admin' && isset($_POST['new_item']) && trim($_POST['new_item']) !== ''){
    $maxId = 0;
    foreach($_SESSION['list'] as $item){
        if(isset($item['id']) && $item['id'] > $maxId){
            $maxId = $item['id'];
        }
    }
    $newId = $maxId + 1;
    $_SESSION['list'][] = ['id'=>$newId, 'nama'=>trim($_POST['new_item'])];
    header("Location: index.php?controller=login&action=dashboard");
    exit();
}

// Hapus item jika role Admin
if($role === 'Admin' && isset($_GET['delete_id'])){
    $deleteId = (int)$_GET['delete_id'];
    foreach($_SESSION['list'] as $key => $item){
        if(isset($item['id']) && $item['id'] === $deleteId){
            unset($_SESSION['list'][$key]);
            $_SESSION['list'] = array_values($_SESSION['list']); // reindex
            break;
        }
    }
    header("Location: index.php?controller=login&action=dashboard");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
html, body { height:100%; font-family:'Poppins',sans-serif; }
body {
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(180deg,#0a0f1a,#1c273a);
    color:white;
}
.dashboard-box {
    width:600px;
    padding:40px 35px;
    background: rgba(15,20,35,0.95);
    border-radius:12px;
    box-shadow:0 0 25px rgba(0,255,255,0.15);
    text-align:center;
}
.dashboard-box h2 { font-size:24px; margin-bottom:15px; font-weight:600; }
.dashboard-box p { font-size:15px; margin-bottom:15px; color:#aaa; }

table {
    width:100%;
    border-collapse: collapse;
    margin-top:10px;
}
table, th, td { border:1px solid #555; }
th, td { padding:8px; text-align:left; }
th { background:#00e6e6; color:#0a0f1a; }
tr:nth-child(even) { background: rgba(255,255,255,0.05); }

input[type="text"] {
    width:70%;
    padding:8px;
    margin-top:10px;
    border-radius:5px;
    border:none;
    outline:none;
}
button {
    padding:6px 12px;
    border:none;
    border-radius:5px;
    background:#00e6e6;
    color:#0a0f1a;
    font-weight:bold;
    cursor:pointer;
}
button:hover { box-shadow:0 0 10px #00ffff; }
a.button {
    display:inline-block;
    text-decoration:none;
    background:#00e6e6;
    color:#0a0f1a;
    padding:8px 18px;
    border-radius:6px;
    font-weight:bold;
    box-shadow:0 0 15px #00e6e6;
    transition:0.3s;
    margin-top:15px;
}
a.button:hover { box-shadow:0 0 25px #00ffff,0 0 50px #00ffff; }
.delete-btn {
    background:red;
    color:white;
    padding:4px 8px;
    border-radius:4px;
    font-size:12px;
}
.delete-btn:hover { box-shadow:0 0 5px #ff6666; }
</style>
</head>
<body>

<div class="dashboard-box">
    <h2>Dashboard</h2>
    <p>Selamat datang, <strong><?= htmlspecialchars($username) ?></strong> (<?= htmlspecialchars($role) ?>)</p>

    <h3>Daftar List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Item</th>
            <?php if($role==='Admin'): ?><th>Aksi</th><?php endif; ?>
        </tr>
        <?php foreach($_SESSION['list'] as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['id'] ?? '-') ?></td>
            <td><?= htmlspecialchars($item['nama'] ?? $item) ?></td>
            <?php if($role==='Admin'): ?>
            <td>
                <a class="delete-btn" href="index.php?controller=login&action=dashboard&delete_id=<?= $item['id'] ?>">Hapus</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if($role === 'Admin'): ?>
        <form method="POST" style="margin-top:10px;">
            <input type="text" name="new_item" placeholder="Tambah item baru" required>
            <button type="submit">Tambah</button>
        </form>
    <?php endif; ?>

    <a class="button" href="index.php?controller=login&action=logout">Logout</a>
</div>

</body>
</html>