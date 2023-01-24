<?php

class BlogFactory
{
    public static function create()
    {
        $conn = mysqli_connect("localhost", "root", "", "blogphp");
        return new Blog($conn);
    }
}
class Blog
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function createNewPost($title, $content)
    {
        $stmt =  $this->conn->prepare("INSERT INTO blog_data(title, content) VALUES(?, ?)");
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
        header("Location: index.php?info=added");
        exit();
    }
}
$blog = BlogFactory::create();
if(isset($_POST['new_post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $blog->createNewPost($title, $content);
}
