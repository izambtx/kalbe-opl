<?php
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation'); ?>">
    <ul class="pagination d-flex justify-content-center" id="ul">
        <?php if ($pager->hasPrevious()) : ?>
            <li id="li">
                <a class="button" id="a" href="<?= $pager->getFirst(); ?>" aria-label="<?= lang('Pager.first'); ?>">
                    <span aria-hidden="true"><i class="fas fa-backward"></i></span>
                </a>
            </li>
            <li id="li">
                <a class="button" id="a" href="<?= $pager->getPrevious(); ?>" aria-label="<?= lang('Pager.previous'); ?>">
                    <span aria-hidden="true"><i class="fas fa-step-backward"></i></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li id="li">
                <a <?= $link['active'] ? 'class="aktif"' : '' ?> id="a" href="<?= $link['uri']; ?>">
                    <?= $link['title']; ?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNext()) : ?>
            <li id="li">
                <a class="button" id="a" href="<?= $pager->getNext(); ?>" aria-label="<?= lang('Pager.next'); ?>">
                    <span aria-hidden="true"><i class="fas fa-step-forward"></i></i></span>
                </a>
            </li>
            <li id="li">
                <a class="button" id="a" href="<?= $pager->getLast(); ?>" aria-label="<?= lang('Pager.last'); ?>">
                    <span aria-hidden="true"><i class="fas fa-forward"></i></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>