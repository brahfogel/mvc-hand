<?php

class PageModel extends Model //Page
{

    public function getListGoods($category, $start = 0)
    {
        ($category == 1)
            ? $strQuery = "SELECT * FROM tovar WHERE ? ORDER BY id DESC LIMIT $start,18"
            : $strQuery = "SELECT * FROM tovar WHERE type=? ORDER BY id DESC LIMIT $start,18";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute(["$category"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListCartProducts($productsId)
    {
        $strQuery = "SELECT * FROM tovar WHERE id IN ($productsId)";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuantityGoods()
    {
        $strQuery = "SELECT COUNT(*), type  FROM tovar WHERE type='needlework' OR type='paintings' OR type='others' GROUP BY type";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGoodsId($varId)
    {
        $strQuery = "SELECT * FROM tovar WHERE id=?";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute(["$varId"]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

//----------------------------------------users

    public function getListUserItems($role, $UserEmail, $start)
    {
        if ($role !== 'admin') {
            $strQuery = "SELECT * FROM tovar WHERE email=? ORDER BY id DESC LIMIT $start,18";
            $dbValues = ["$UserEmail"];
        }
        else {
            $strQuery = "SELECT * FROM tovar ORDER BY id DESC LIMIT $start,18";
            $dbValues = [];
        }
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute($dbValues);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountUserItems($role, $userEmail)
    {
        if ($role !== 'admin') {
            $strQuery = "SELECT COUNT(*), email  FROM tovar WHERE email=? GROUP BY email";
            $dbValues = ["$userEmail"];
        }
        else {
            $strQuery = "SELECT COUNT(*) FROM tovar";
            $dbValues = [];
        }
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute($dbValues);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//----------------------------------------change db

    public function save($email, $data, $dataId = 0)
    {
        if ($dataId) {
            $strQuery = 'UPDATE tovar SET name = ?, img = ?, about = ?, type = ?, price = ? WHERE id = ?';
            $dbValues = [$data['name'], $data['img'], $data['about'], $data['type'], $data['price'], "$dataId"];

        }
        else {
            $strQuery = 'INSERT INTO tovar (name, img, about, type, email, price) VALUES (? , ? , ? , ? , ? , ?)';
            $dbValues = [$data['name'], $data['img'], $data['about'], $data['type'], "$email", $data['price']];
        }
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute($dbValues);
        return $this->db->commit();
        /*$id = $this->db->lastInsertId();
        return $id;*/
    }

    public function delete($id)
    {
        if (!empty($id) && is_numeric($id)) {
            $strQuery = "DELETE FROM tovar WHERE id = ?";
            $stmt = $this->db->prepare($strQuery);
            $stmt->execute([$id]);
            return $this->db->commit();
        }
        return false;
    }

//----------------------------------------access

    public function getUserByEmail($email)
    {
        $strQuery = "SELECT * FROM users WHERE email = ? ";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setUser($login, $email, $role, $pass)
    {
        $strQuery = "INSERT INTO users (login, email, role, password, is_active) VALUES (? , ? , ? , ? , ?)";
        $stmt = $this->db->prepare($strQuery);
        $stmt->execute(["$login", "$email", "$role", "$pass", "1"]);
        return $this->db->commit();
    }

}








