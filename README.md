# moodle_block_teams_sync
teams sync block for moodle

[English Version](/README.en.md)

## 説明
このプラグインは、Moodle-Teams 連携を、各コースで教師が選択できるようにするために作成されました。  
コースにTeams同期ブロックを追加し、ブロック中の「同期する」をクリックすると、同期するコースのIDをコンフィグに書き込むことで、
Microsoft office365連携プラグインのタスクにより、Teams に自動的にコースのチームが作成されます。

## インストール
通常のブロックプラグインと同様です。  
Moodle の blocks 配下に teams_sync/ を展開し、管理ページにアクセスします。

## 更新（Jun.5.2020）
Teams同期を解除する機能を追加しました。Teams同期ブロック内の「同期を解除する」をクリックすると、
o365のグループが削除され、Teams のチームが削除されます。

## 注意点
- 先に [Microsoft office365連携プラグイン](https://moodle.org/plugins/local_o365) のインストールが必要です。
- Microsoft office365連携プラグインの設定でTeams 同期を「Customize」に
  設定する必要があります。
- 排他制御はしていないので、複数のコースで同時に同期設定が行われた場合の挙動は不明です。
