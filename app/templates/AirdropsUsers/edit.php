<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AirdropsUser $airdropsUser
 * @var string[]|\Cake\Collection\CollectionInterface $airdrops
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $airdropsUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $airdropsUser->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Airdrops Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="airdropsUsers form content">
            <?= $this->Form->create($airdropsUser) ?>
            <fieldset>
                <legend><?= __('Edit Airdrops User') ?></legend>
                <?php
                    echo $this->Form->control('airdrop_id', ['options' => $airdrops]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('amount');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
