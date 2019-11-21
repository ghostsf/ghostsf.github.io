---
title: 善用 Android Studio 的异动管理功能
date: 2019-11-21 14:38:15
tags: AndroidStudio
categories: 分享境
---

> 看到一篇难得的关于Android Studio 的异动管理功能的说明文章，姑且转载分享之
> 图片还没整理好 太懒了 后续再慢慢整理 完善吧

身为一个开发人员，每天的工作就是在不断地异动 Source Code 中度过。增加新的、修改旧的、删掉不要的，而每一个异动都会对应到特定的目的，像是为了新的需求、修改 Bug、重构程式等等。

很多时候，异动的目的在工作的过程中是混在一起的，例如开发新功能的同时，也有可能在修正之前的问题。在自己的工作环境中，这些异动混在一起通常都不会有什么问题产生。只不过这些工作的成果终究是要交付出去的，而问题总在于这些目的却不一定是在同一个时间点被交付。如果所有的异动都混在一起，要隔离出需要交付的部份，势必要花费一番工夫才能办得到。

而这样的工作要靠人工来逐个 Block、逐个 File 来分辨识，不但耗时，同时也极有可能出现疏漏。因为一个修改就有可能牵涉到十几个 Files，再加上 IDE 自动产生或管理的加一加可能就有成百上千之数。自己经手的异动都不一定能精确的掌握，更何况是数量在数倍、完全不是自己产生的内容。

人工应付不来，就得要靠工具的辅助。就如同在“ [如何写好程序](https://www.jianshu.com/p/50ab4a02c19f) ”一文中提到，善用工具是写好程序的功课之一。以开发 Android 时所使用的 Android Studio 来说，虽然是由 IntelliJ IDEA Community 版本进化而来，但不代表功能上就很阳春。针对本文提到的问题，其实有内建了相当方便的功能，可以协助开发者解决这类工作上的问题。

## Android Studio 提供的异动管理功能
### Changelist
这是一个以 File 为单位，把异动内容给分门别类的功能。透过这个功能，可以把修改过的 File 进行分组。当有异动内容需要被交付时，可以直接以分好的组别为单位交付。像是要进行 Commit 时，则可以指定特定的 Changelist 来 Commit，不在分组内的 Files 则不会受影响。

要使用这个功能可以先进入 Version Control Tool Window，Menu 的位置在【View -> Tool Windows -> Version Control】。开启之后可以看见如下图示的内容：

<!--![]()-->

在 Local Changes 的 Tab 中，可以看到有一个 `` Default `` 的字样，这就是 Android Studio 预先产生好的 Changelist。如果没有特别指定，所有被异动的 Files 都会被归在这个 Changelist 之下。在操作上可以使用 Tool Window 中左方的按钮来新增一个 Changelist，新增时可设定此 Changelist 为 Active，代表之后所有还没被异动的 File，在异动后都会被归到这个 Changelist 之下。

要在 Changelist 之间移动 File 也非常地直觉，可以使用拖拉项目的方式，或是在项目上按下滑鼠右键选择【Move to Another Changelist...】即可。

当要进行 Commit 时，就可以在如下的“Commit Changes”画面中，最上方的下拉清单选择对应的 Changelist。


选择不同的 Changelist 时，Changelist 的名称会预设成为 Commit Message 的内容。

由于 Changelist 是以 File 为单位，所以会有一个限制是同一个 File 不能同时归属于二个 Changelist。一旦编辑了不在 Active Changelist 中的 File，Android Studio 就会出现以下的警告：


可以看见 Tab 上的文件名变成了红色，这是 Android Studio 遇到异动冲突预设的反应，这部份可以透过点选画面中最右方的按钮来调整。

这时如果只是忘了切换 Active Changelist，可以选择【Ignore】或是【Switch changelist】。但若真的是二个不同的修改项目都异动到同一个 File，那就得选择一个适当的策略。

当修改的内容不会有交互的影响，也就是说二个修改项目的结果可以共存在同一个 File 之中，则可以选择【Move changes】把 File 移到最先要被 Commit 的 Changelist 中。

反之，修改的内容是互斥的时候，就要先保留其中一个版本、还原回修改前的状态后，再开始另一个项目的修改。这个方式在 Android Studio 中也有提供了对应的功能来达成，在这篇文章的稍后会提到。

Changelist 在使用的情境上，还可以用来区隔一定会修改，但却没有要 Commit 的 File。例如有一些程序运行时需要的配置文件，内容中记录的是 Production 的参数，在开发时就必须要进行修改才能做调试。这时就可以预先新增好一个专用的 Changelist，把这类的 Files 在修改之后归进去。未来在 Commit 时才不致一时疏忽，把开发环境的设定参数给 Commit，造成后续生成上的问题。

### Label
Label 主要是作用在【VCS -> Local History -> Show History】的 Window 上，如下图所示：


在 Window 的左侧，可以看到第一个和第二个 History 项目中间，夹了一个 Sample Label 的文字，这个文字是使用【VCS -> Local History -> Put Label...】功能放上去的。

透过这个功能，可以在进行一些实验性的调整之前，先标定好目前 Source Code 状态。当调整不如预期时，就可以不用花精神去回想做了哪些的修改，再一一去做回复。有了 Label 就可以在 History 的清单中找到所标定的 Source Code 状态，使用【Revert】的功能，直接回到调整前的状态，相当地省事又有效率。

### Shelf
字面上的意义就是架子，是一个用来摆放文件夹的架子。而文件夹则是前面所提到的 Changelist 的快照，所以当 Changelist 发生冲突时，就可以利用 Shelf 把 Changelist 当下的状态保留起来，等到冲突的情况解决了之后，再把原本异动的内容还原回来。

要把 Changelist 放到架子上，可以从 Menu 中选择【VCS -> Shelve Changes...】。


可以由上图看到，画面和 Commit 差不多。完成之后，会在 Version Control Tool Window 中多出一个 Shelf 的 Tab，同时被 Shelve 的 Files 会回到异动前的状态。在 Shelf 的 Tab 上，可以管理 Shelve 过的项目，像是 Unshelve、Rename、Delete。

在 Unshelve 的过程中，如果没有出现内容冲突，则会自动套用 Shelf 中保留的异动状态。如果内容出现冲突时，则会显示以下的 Window，要求决定所需套用的版本：


Shelf 除了应用在工作项目的切换之外，如果所开发的 Project 有多个 Branch，在 Branch 还没有相互 Merge 之前，也可以使用 Shelf 来转移、把异动过程套用在不同的 Branch 上。这一点在异动的 Files 数量庞大时，就可以显现出效率上差别，一个批次就可以完成工作，不用再一个个 File 来比对，并且担心是否有异动的内容遗漏了。

### Patch
Patch 可以算是 Shelf 的外带版本，外带去哪？就是把异动的内容带出 Android Studio 的环境之外。使用 Menu 中【VCS -> Create Patch...】的功能，可以把原本要新增到 Shelf 的项目，改为产生一个实体的 File。操作的画面和 Shelve Changes 一模一样，只是在按下 Window 上【Create Patch...】的按钮后，会出现以下的画面，以便指定 File 储存的位置。


基本上 Shelf 的项目和 Patch 可以互换，在 Tool Window 中 Shelf 的项目上可以触发 Create Patch 的动作，让 Shelf 的项目转成 Patch。反之，也可以在 Shelf 的 Tab 上 Import Patches 成为 Shelf 的项目。在产生 Shelf 项目和 Patch 时，还有一点最大的差异是 Patch 产生之后，并不会将内容回复到异动之前，而是维持修改后的状态。

从 Menu 中选择【VCS -> Apply Patch...】后，可以把 Patch 的内容套用回目前的工作环境中，套用的过程和 Shelf 差不多，遇到内容冲突时也同样会出现相同的画面，来决定要选用的版本。

在应用上，Shelf 的项目能做的 Patch 都能做，除此之外 Patch 还可以用来在不同的 Android Studio 环境之间移转。可以用来将工作的状态由公司的环境中移至家中的环境，以便在离开公司之后仍可接续未完成的部份。或者是可以把 Patch 交给不同的开发人员，用来进行协同合作、Review Code 等工作。

和版本控管工具的比较
如果在开发时使用 Git 做为版本控管的工具，其实以上的功能 Git 大多都可以做到。Android Studio 则是在原有的版本控管机制之外，提供不同的选项，对于不熟悉版本控管工具的人来说有莫大的帮助。而对于用惯了原本工具的人来说，要怎么使用还是得看每个人的习惯、对工具的喜好程度。只不过在面对不同的情况之下，多学会一种工具的使用，在应对的策略上也能产生更多的弹性。



作者：_WZ_

链接：https://www.jianshu.com/p/f66e3ad097ad

来源：简书

著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。