<?php
require('shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<?php
$result = $db->query("SELECT * FROM texts WHERE id=" . $_POST['id']);
?>

<div class="note-view">
  <p class="name"><?= $result[0]['name'] ?></p>
  <?= var_dump($result); ?>
  <p>
    <span class="date">January 1, 2019</span>
    <span class="size">150kb</span>
  </p>
  <pre>
    rwildcard=$(foreach d,$(wildcard $1*),$(call rwildcard,$d/,$2)$(filter $(subst *,%,$2),$d))
    src = $(call rwildcard,src/,*.cpp *.c)
    obj = $(patsubst %,obj/%.o,$(basename $(notdir $(src))))

    $(info src: [$(src)])
    $(info obj: [$(obj)])

    game.exe: $(obj)
        g++ $^ -o $@

    define objFromSrc
    $(1): $(2)
        $(info $(1) $(2))
        g++ -c $(2) -o $(1)
    endef

    $(foreach t,$(src),$(call objFromSrc,$(patsubst %,obj/%.o,$(basename $(notdir $(t)))),$(t)))

    src: [src/dir/main.cpp src/dir/dir2/other3.cpp src/dir/other2.cpp src/other.c]
    obj: [obj/main.o obj/other3.o obj/other2.o obj/other.o]
    obj/main.o src/dir/main.cpp
    obj/other3.o src/dir/dir2/other3.cpp
    obj/other2.o src/dir/other2.cpp
    obj/other.o src/other.c
    makefile:20: *** multiple target patterns.  Stop.
  </pre>
</div>

</body>
</html>
