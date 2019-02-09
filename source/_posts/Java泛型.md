title: Java泛型
categories: 旧文字
tags: [java,泛型]
date: 2015-07-17 04:42:40
---
什么是泛型？
泛型（Generic type 或者 generics）是对 Java 语言的类型系统的一种扩展，以支持创建可以按类型进行参数化的类。可以把类型参数看作是使用参数化类型时指定的类型的一个占位符，就像方法的形式参数是运行时传递的值的占位符一样。

可以在集合框架（Collection framework）中看到泛型的动机。例如，Map 类允许您向一个 Map 添加任意类的对象，即使最常见的情况是在给定映射（map）中保存某个特定类型（比如 String）的对象。

因为 Map.get() 被定义为返回 Object，所以一般必须将 Map.get() 的结果强制类型转换为期望的类型，如下面的代码所示：

Map m = new HashMap();
m.put("key", "blarg");
String s = (String) m.get("key");

要让程序通过编译，必须将 get() 的结果强制类型转换为 String，并且希望结果真的是一个 String。但是有可能某人已经在该映射中保存了不是 String 的东西，这样的话，上面的代码将会抛出 ClassCastException。

理想情况下，您可能会得出这样一个观点，即 m 是一个 Map，它将 String 键映射到 String 值。这可以让您消除代码中的强制类型转换，同时获得一个附加的类型检查层，该检查层可以防止有人将错误类型的键或值保存在集合中。这就是泛型所做的工作。

<!--more-->


泛型的好处

Java 语言中引入泛型是一个较大的功能增强。不仅语言、类型系统和编译器有了较大的变化，以支持泛型，而且类库也进行了大翻修，所以许多重要的类，比如集合框架，都已经成为泛型化的了。这带来了很多好处：

类型安全。 泛型的主要目标是提高 Java 程序的类型安全。通过知道使用泛型定义的变量的类型限制，编译器可以在一个高得多的程度上验证类型假设。没有泛型，这些假设就只存在于程序员的头脑中（或者如果幸运的话，还存在于代码注释中）。

Java 程序中的一种流行技术是定义这样的集合，即它的元素或键是公共类型的，比如“String 列表”或者“String 到 String 的映射”。通过在变量声明中捕获这一附加的类型信息，泛型允许编译器实施这些附加的类型约束。类型错误现在就可以在编译时被捕获了，而不是在运行时当作 ClassCastException 展示出来。将类型检查从运行时挪到编译时有助于您更容易找到错误，并可提高程序的可靠性。

消除强制类型转换。 泛型的一个附带好处是，消除源代码中的许多强制类型转换。这使得代码更加可读，并且减少了出错机会。

尽管减少强制类型转换可以降低使用泛型类的代码的罗嗦程度，但是声明泛型变量会带来相应的罗嗦。比较下面两个代码例子。

该代码不使用泛型：

List li = new ArrayList();
li.put(new Integer(3));
Integer i = (Integer) li.get(0);


该代码使用泛型：

List<Integer> li = new ArrayList<Integer>();
li.put(new Integer(3));
Integer i = li.get(0);


在简单的程序中使用一次泛型变量不会降低罗嗦程度。但是对于多次使用泛型变量的大型程序来说，则可以累积起来降低罗嗦程度。

潜在的性能收益。 泛型为较大的优化带来可能。在泛型的初始实现中，编译器将强制类型转换（没有泛型的话，程序员会指定这些强制类型转换）插入生成的字节码中。但是更多类型信息可用于编译器这一事实，为未来版本的 JVM 的优化带来可能。

由于泛型的实现方式，支持泛型（几乎）不需要 JVM 或类文件更改。所有工作都在编译器中完成，编译器生成类似于没有泛型（和强制类型转换）时所写的代码，只是更能确保类型安全而已。


泛型用法的例子

泛型的许多最佳例子都来自集合框架，因为泛型让您在保存在集合中的元素上指定类型约束。考虑这个使用 Map 类的例子，其中涉及一定程度的优化，即 Map.get() 返回的结果将确实是一个 String：


Map m = new HashMap();
m.put("key", "blarg");
String s = (String) m.get("key");


如果有人已经在映射中放置了不是 String 的其他东西，上面的代码将会抛出 ClassCastException。泛型允许您表达这样的类型约束，即 m 是一个将 String 键映射到 String 值的 Map。这可以消除代码中的强制类型转换，同时获得一个附加的类型检查层，这个检查层可以防止有人将错误类型的键或值保存在集合中。

下面的代码示例展示了 JDK 5.0 中集合框架中的 Map 接口的定义的一部分：


public interface Map<K, V> {
public void put(K key, V value);
public V get(K key);
}

注意该接口的两个附加物：

类型参数 K 和 V 在类级别的规格说明，表示在声明一个 Map 类型的变量时指定的类型的占位符。

在 get()、put() 和其他方法的方法签名中使用的 K 和 V。

为了赢得使用泛型的好处，必须在定义或实例化 Map 类型的变量时为 K 和 V 提供具体的值。以一种相对直观的方式做这件事：

Map<String, String> m = new HashMap<String, String>();
m.put("key", "blarg");
String s = m.get("key");

当使用 Map 的泛型化版本时，您不再需要将 Map.get() 的结果强制类型转换为 String，因为编译器知道 get() 将返回一个 String。

在使用泛型的版本中并没有减少键盘录入；实际上，比使用强制类型转换的版本需要做更多键入。使用泛型只是带来了附加的类型安全。因为编译器知道关于您将放进 Map 中的键和值的类型的更多信息，所以类型检查从执行时挪到了编译时，这会提高可靠性并加快开发速度。


向后兼容

在 Java 语言中引入泛型的一个重要目标就是维护向后兼容。尽管 JDK 5.0 的标准类库中的许多类，比如集合框架，都已经泛型化了，但是使用集合类（比如 HashMap 和 ArrayList）的现有代码将继续不加修改地在 JDK 5.0 中工作。当然，没有利用泛型的现有代码将不会赢得泛型的类型安全好处。

 


二 泛型基础

类型参数

在定义泛型类或声明泛型类的变量时，使用尖括号来指定形式类型参数。形式类型参数与实际类型参数之间的关系类似于形式方法参数与实际方法参数之间的关系，只是类型参数表示类型，而不是表示值。

泛型类中的类型参数几乎可以用于任何可以使用类名的地方。例如，下面是 java.util.Map 接口的定义的摘录：

public interface Map<K, V> {
public void put(K key, V value);
public V get(K key);
}

Map 接口是由两个类型参数化的，这两个类型是键类型 K 和值类型 V。（不使用泛型）将会接受或返回 Object 的方法现在在它们的方法签名中使用 K 或 V，指示附加的类型约束位于 Map 的规格说明之下。

当声明或者实例化一个泛型的对象时，必须指定类型参数的值：

Map<String, String> map = new HashMap<String, String>();

注意，在本例中，必须指定两次类型参数。一次是在声明变量 map 的类型时，另一次是在选择 HashMap 类的参数化以便可以实例化正确类型的一个实例时。

编译器在遇到一个 Map<String, String> 类型的变量时，知道 K 和 V 现在被绑定为 String，因此它知道在这样的变量上调用 Map.get() 将会得到 String 类型。

除了异常类型、枚举或匿名内部类以外，任何类都可以具有类型参数。


命名类型参数

推荐的命名约定是使用大写的单个字母名称作为类型参数。这与 C++ 约定有所不同（参阅 附录 A：与 C++ 模板的比较），并反映了大多数泛型类将具有少量类型参数的假定。对于常见的泛型模式，推荐的名称是：

K —— 键，比如映射的键。 
V —— 值，比如 List 和 Set 的内容，或者 Map 中的值。 
E —— 异常类。 
T —— 泛型。


泛型不是协变的

关于泛型的混淆，一个常见的来源就是假设它们像数组一样是协变的。其实它们不是协变的。List<Object> 不是 List<String> 的父类型。

如果 A 扩展 B，那么 A 的数组也是 B 的数组，并且完全可以在需要 B[] 的地方使用 A[]：

Integer[] intArray = new Integer[10]; 
Number[] numberArray = intArray;

上面的代码是有效的，因为一个 Integer 是 一个 Number，因而一个 Integer 数组是 一个 Number 数组。但是对于泛型来说则不然。下面的代码是无效的：

List<Integer> intList = new ArrayList<Integer>();
List<Number> numberList = intList; // invalid

最初，大多数 Java 程序员觉得这缺少协变很烦人，或者甚至是“坏的（broken）”，但是之所以这样有一个很好的原因。如果可以将 List<Integer> 赋给 List<Number>，下面的代码就会违背泛型应该提供的类型安全：

List<Integer> intList = new ArrayList<Integer>();
List<Number> numberList = intList; // invalid
numberList.add(new Float(3.1415));

因为 intList 和 numberList 都是有别名的，如果允许的话，上面的代码就会让您将不是 Integers 的东西放进 intList 中。但是，正如下一屏将会看到的，您有一个更加灵活的方式来定义泛型。


类型通配符

假设您具有该方法：

void printList(List l) { 
for (Object o : l) 
    System.out.println(o); 
}

上面的代码在 JDK 5.0 上编译通过，但是如果试图用 List<Integer> 调用它，则会得到警告。出现警告是因为，您将泛型（List<Integer>）传递给一个只承诺将它当作 List（所谓的原始类型）的方法，这将破坏使用泛型的类型安全。

如果试图编写像下面这样的方法，那么将会怎么样？

void printList(List<Object> l) { 
for (Object o : l) 
    System.out.println(o); 
}

它仍然不会通过编译，因为一个 List<Integer> 不是 一个 List<Object>（正如前一屏 泛型不是协变的 中所学的）。这才真正烦人 —— 现在您的泛型版本还没有普通的非泛型版本有用！

解决方案是使用类型通配符：

void printList(List<?> l) { 
for (Object o : l) 
    System.out.println(o); 
}

上面代码中的问号是一个类型通配符。它读作“问号”。List<?> 是任何泛型 List 的父类型，所以您完全可以将 List<Object>、List<Integer> 或 List<List<List<Flutzpah>>> 传递给 printList()。


类型通配符的作用

前一屏 类型通配符 中引入了类型通配符，这让您可以声明 List<?> 类型的变量。您可以对这样的 List 做什么呢？非常方便，可以从中检索元素，但是不能添加元素。原因不是编译器知道哪些方法修改列表哪些方法不修改列表，而是（大多数）变化的方法比不变化的方法需要更多的类型信息。下面的代码则工作得很好：

List<Integer> li = new ArrayList<Integer>();
li.add(new Integer(42));
List<?> lu = li;
System.out.println(lu.get(0));

为什么该代码能工作呢？对于 lu，编译器一点都不知道 List 的类型参数的值。但是编译器比较聪明，它可以做一些类型推理。在本例中，它推断未知的类型参数必须扩展 Object。（这个特定的推理没有太大的跳跃，但是编译器可以作出一些非常令人佩服的类型推理，后面就会看到（在 底层细节 一节中）。所以它让您调用 List.get() 并推断返回类型为 Object。

另一方面，下面的代码不能工作：

List<Integer> li = new ArrayList<Integer>();
li.add(new Integer(42));
List<?> lu = li;
lu.add(new Integer(43)); // error

在本例中，对于 lu，编译器不能对 List 的类型参数作出足够严密的推理，以确定将 Integer 传递给 List.add() 是类型安全的。所以编译器将不允许您这么做。

以免您仍然认为编译器知道哪些方法更改列表的内容哪些不更改列表内容，请注意下面的代码将能工作，因为它不依赖于编译器必须知道关于 lu 的类型参数的任何信息：

List<Integer> li = new ArrayList<Integer>();
li.add(new Integer(42));
List<?> lu = li;
lu.clear();


泛型方法

（在 类型参数 一节中）您已经看到，通过在类的定义中添加一个形式类型参数列表，可以将类泛型化。方法也可以被泛型化，不管它们定义在其中的类是不是泛型化的。

泛型类在多个方法签名间实施类型约束。在 List<V> 中，类型参数 V 出现在 get()、add()、contains() 等方法的签名中。当创建一个 Map<K, V> 类型的变量时，您就在方法之间宣称一个类型约束。您传递给 add() 的值将与 get() 返回的值的类型相同。

类似地，之所以声明泛型方法，一般是因为您想要在该方法的多个参数之间宣称一个类型约束。例如，下面代码中的 ifThenElse() 方法，根据它的第一个参数的布尔值，它将返回第二个或第三个参数：

public <T> T ifThenElse(boolean b, T first, T second) {
return b ? first : second;
}

注意，您可以调用 ifThenElse()，而不用显式地告诉编译器，您想要 T 的什么值。编译器不必显式地被告知 T 将具有什么值；它只知道这些值都必须相同。编译器允许您调用下面的代码，因为编译器可以使用类型推理来推断出，替代 T 的 String 满足所有的类型约束：

String s = ifThenElse(b, "a", "b");

类似地，您可以调用：

Integer i = ifThenElse(b, new Integer(1), new Integer(2));

但是，编译器不允许下面的代码，因为没有类型会满足所需的类型约束：

String s = ifThenElse(b, "pi", new Float(3.14));

为什么您选择使用泛型方法，而不是将类型 T 添加到类定义呢？（至少）有两种情况应该这样做：

当泛型方法是静态的时，这种情况下不能使用类类型参数。

当 T 上的类型约束对于方法真正是局部的时，这意味着没有在相同类的另一个 方法签名中使用相同 类型 T 的约束。通过使得泛型方法的类型参数对于方法是局部的，可以简化封闭类型的签名。


有限制类型

在前一屏 泛型方法 的例子中，类型参数 V 是无约束的或无限制的 类型。有时在还没有完全指定类型参数时，需要对类型参数指定附加的约束。

考虑例子 Matrix 类，它使用类型参数 V，该参数由 Number 类来限制：

public class Matrix<V extends Number> { ... }

编译器允许您创建 Matrix<Integer> 或 Matrix<Float> 类型的变量，但是如果您试图定义 Matrix<String> 类型的变量，则会出现错误。类型参数 V 被判断为由 Number 限制 。在没有类型限制时，假设类型参数由 Object 限制。这就是为什么前一屏 泛型方法 中的例子，允许 List.get() 在 List<?> 上调用时返回 Object，即使编译器不知道类型参数 V 的类型。

 

三 一个简单的泛型类

编写基本的容器类

此时，您可以开始编写简单的泛型类了。到目前为止，泛型类最常见的用例是容器类（比如集合框架）或者值持有者类（比如 WeakReference 或 ThreadLocal）。我们来编写一个类，它类似于 List，充当一个容器。其中，我们使用泛型来表示这样一个约束，即 Lhist 的所有元素将具有相同类型。为了实现起来简单，Lhist 使用一个固定大小的数组来保存值，并且不接受 null 值。

Lhist 类将具有一个类型参数 V（该参数是 Lhist 中的值的类型），并将具有以下方法：

public class Lhist<V> { 
public Lhist(int capacity) { ... }
public int size() { ... }
public void add(V value) { ... }
public void remove(V value) { ... }
public V get(int index) { ... }
}

要实例化 Lhist，只要在声明时指定类型参数和想要的容量：

Lhist<String> stringList = new Lhist<String>(10);


实现构造函数

在实现 Lhist 类时，您将会遇到的第一个拦路石是实现构造函数。您可能会像下面这样实现它：

public class Lhist<V> { 
private V[] array;
public Lhist(int capacity) {
    array = new V[capacity]; // illegal
}
}

这似乎是分配后备数组最自然的一种方式，但是不幸的是，您不能这样做。具体原因很复杂，当学习到 底层细节 一节中的“擦除”主题时，您就会明白。分配后备数组的实现方式很古怪且违反直觉。下面是构造函数的一种可能的实现（该实现使用集合类所采用的方法）：

public class Lhist<V> { 
private V[] array;
public Lhist(int capacity) {
    array = (V[]) new Object[capacity];
}
}


另外，也可以使用反射来实例化数组。但是这样做需要给构造函数传递一个附加的参数 —— 一个类常量，比如 Foo.class。后面在 Class<T> 一节中将讨论类常量。


实现方法

实现 Lhist 的方法要容易得多。下面是 Lhist 类的完整实现：

public class Lhist<V> {
    private V[] array;
    private int size;

    public Lhist(int capacity) {
        array = (V[]) new Object[capacity];
    }

    public void add(V value) {
        if (size == array.length)
            throw new IndexOutOfBoundsException(Integer.toString(size));
        else if (value == null)
            throw new NullPointerException();
        array[size++] = value;
    }

    public void remove(V value) {
        int removalCount = 0;
        for (int i=0; i<size; i++) {
            if (array[i].equals(value))
                ++removalCount;
            else if (removalCount > 0) {
                array[i-removalCount] = array[i];
                array[i] = null;
            }
        }
        size -= removalCount;
    }

    public int size() { return size; }

    public V get(int i) {
        if (i >= size)
            throw new IndexOutOfBoundsException(Integer.toString(i));
        return array[i];
    }
}

注意，您在将会接受或返回 V 的方法中使用了形式类型参数 V，但是您一点也不知道 V 具有什么样的方法或域，因为这些对泛型代码是不可知的。


使用 Lhist 类

使用 Lhist 类很容易。要定义一个整数 Lhist，只需要在声明和构造函数中为类型参数提供一个实际值即可：

Lhist<Integer> li = new Lhist<Integer>(30);

编译器知道，li.get() 返回的任何值都将是 Integer 类型，并且它还强制传递给 li.add() 或 li.remove() 的任何东西都是 Integer。除了实现构造函数的方式很古怪之外，您不需要做任何十分特殊的事情以使 Lhist 是一个泛型类。

 

四 Java类库中的泛型

集合类

到目前为止，Java 类库中泛型支持存在最多的地方就是集合框架。就像容器类是 C++ 语言中模板的主要动机一样（参阅 附录 A：与 C++ 模板的比较）（尽管它们随后用于很多别的用途），改善集合类的类型安全是 Java 语言中泛型的主要动机。集合类也充当如何使用泛型的模型，因为它们演示了泛型的几乎所有的标准技巧和方言。

所有的标准集合接口都是泛型化的 —— Collection<V>、List<V>、Set<V> 和 Map<K,V>。类似地，集合接口的实现都是用相同类型参数泛型化的，所以 HashMap<K,V> 实现 Map<K,V> 等。

集合类也使用泛型的许多“技巧”和方言，比如上限通配符和下限通配符。例如，在接口 Collection<V> 中，addAll 方法是像下面这样定义的：

interface Collection<V> {
boolean addAll(Collection<? extends V>);
}

该定义组合了通配符类型参数和有限制类型参数，允许您将 Collection<Integer> 的内容添加到 Collection<Number>。

如果类库将 addAll() 定义为接受 Collection<V>，您就不能将 Collection<Integer> 的内容添加到 Collection<Number>。不是限制 addAll() 的参数是一个与您将要添加到的集合包含相同类型的集合，而有可能建立一个更合理的约束，即传递给 addAll() 的集合的元素 适合于添加到您的集合。有限制类型允许您这样做，并且使用有限制通配符使您不需要使用另一个不会用在其他任何地方的占位符名称。

应该可以将 addAll() 的类型参数定义为 Collection<V>。但是，这不但没什么用，而且还会改变 Collection 接口的语义，因为泛型版本的语义将会不同于非泛型版本的语义。这阐述了泛型化一个现有的类要比定义一个新的泛型类难得多，因为您必须注意不要更改类的语义或者破坏现有的非泛型代码。

作为泛型化一个类（如果不小心的话）如何会更改其语义的一个更加微妙的例子，注意 Collection.removeAll() 的参数的类型是 Collection<?>，而不是 Collection<? extends V>。这是因为传递混合类型的集合给 removeAll() 是可接受的，并且更加限制地定义 removeAll 将会更改方法的语义和有用性。

 

其他容器类

除了集合类之外，Java 类库中还有几个其他的类也充当值的容器。这些类包括 WeakReference、SoftReference 和 ThreadLocal。它们都已经在其包含的值的类型上泛型化了，所以 WeakReference<T> 是对 T 类型的对象的弱引用，ThreadLocal<T> 则是到 T 类型的线程局部变量的句柄。


泛型不止用于容器

泛型最常见最直观的使用是容器类，比如集合类或引用类（比如 WeakReference<T>）。Collection<V> 中类型参数的含义很明显 —— “一个所有值都是 V 类型的集合”。类似地，ThreadLocal<T> 也有一个明显的解释 —— “一个其类型是 T 的线程局部变量”。但是，泛型规格说明中没有指定容积。

像 Comparable<T> 或 Class<T> 这样的类中类型参数的含义更加微妙。有时，就像 Class<T> 中一样，类型变量主要是帮助编译器进行类型推理。有时，就像隐含的 Enum<E extends Enum<E>> 中一样，类型变量只是在类层次结构上加一个约束。


Comparable<T>

Comparable 接口已经泛型化了，所以实现 Comparable 的对象声明它可以与什么类型进行比较。（通常，这是对象本身的类型，但是有时也可能是父类。）

public interface Comparable<T> { 
public boolean compareTo(T other);
}

所以 Comparable 接口包含一个类型参数 T，该参数是一个实现 Comparable 的类可以与之比较的对象的类型。这意味着如果定义一个实现 Comparable 的类，比如 String，就必须不仅声明类支持比较，还要声明它可与什么比较（通常是与它本身比较）：

public class String implements Comparable<String> { ... }

现在来考虑一个二元 max() 方法的实现。您想要接受两个相同类型的参数，二者都是 Comparable，并且相互之间是 Comparable。幸运的是，如果使用泛型方法和有限制类型参数的话，这相当直观：

public static <T extends Comparable<T>> T max(T t1, T t2) {
if (t1.compareTo(t2) > 0)
    return t1;
else 
    return t2;
}

在本例中，您定义了一个泛型方法，在类型 T 上泛型化，您约束该类型扩展（实现） Comparable<T>。两个参数都必须是 T 类型，这表示它们是相同类型，支持比较，并且相互可比较。容易！

更好的是，编译器将使用类型推理来确定当调用 max() 时 T 的值表示什么意思。所以根本不用指定 T，下面的调用就能工作：

String s = max("moo", "bark");

编译器将计算出 T 的预定值是 String，因此它将进行编译和类型检查。但是如果您试图用不实现 Comparable<X> 的 类 X 的参数调用 max()，那么编译器将不允许这样做。

 

Class<T>

类 Class 已经泛型化了，但是很多人一开始都感觉其泛型化的方式很混乱。Class<T> 中类型参数 T 的含义是什么？事实证明它是所引用的类接口。怎么会是这样的呢？那是一个循环推理？如果不是的话，为什么这样定义它？

在以前的 JDK 中，Class.newInstance() 方法的定义返回 Object，您很可能要将该返回类型强制转换为另一种类型：

class Class { 
Object newInstance();
}

但是使用泛型，您定义 Class.newInstance() 方法具有一个更加特定的返回类型：

class Class<T> { 
T newInstance();
}

如何创建一个 Class<T> 类型的实例？就像使用非泛型代码一样，有两种方式：调用方法 Class.forName() 或者使用类常量 X.class。Class.forName() 被定义为返回 Class<?>。另一方面，类常量 X.class 被定义为具有类型 Class<X>，所以 String.class 是 Class<String> 类型的。

让 Foo.class 是 Class<Foo> 类型的有什么好处？大的好处是，通过类型推理的魔力，可以提高使用反射的代码的类型安全。另外，还不需要将 Foo.class.newInstance() 强制类型转换为 Foo。

考虑一个方法，它从数据库检索一组对象，并返回 JavaBeans 对象的一个集合。您通过反射来实例化和初始化创建的对象，但是这并不意味着类型安全必须完全被抛至脑后。考虑下面这个方法：

public static<T> List<T> getRecords(Class<T> c, Selector s) {
// Use Selector to select rows
List<T> list = new ArrayList<T>();
for (/* iterate over results */) {
    T row = c.newInstance();
    // use reflection to set fields from result
    list.add(row); 
}
return list;
}

可以像下面这样简单地调用该方法：

List<FooRecord> l = getRecords(FooRecord.class, fooSelector);

编译器将会根据 FooRecord.class 是 Class<FooRecord> 类型的这一事实，推断 getRecords() 的返回类型。您使用类常量来构造新的实例并提供编译器在类型检查中要用到的类型信息。

 

用 Class<T> 替换 T[]

Collection 接口包含一个方法，用于将集合的内容复制到一个调用者指定类型的数组中：

public Object[] toArray(Object[] prototypeArray) { ... }

toArray(Object[]) 的语义是，如果传递的数组足够大，就会使用它来保存结果，否则，就会使用反射分配一个相同类型的新数组。一般来说，单独传递一个数组作为参数来提供想要的返回类型是一个小技巧，但是在引入泛型之前，这是与方法交流类型信息最方便的方式。

有了泛型，就可以用一种更加直观的方式来做这件事。不像上面这样定义 toArray()，泛型 toArray() 可能看起来像下面这样：

public<T> T[] toArray(Class<T> returnType)

调用这样一个 toArray() 方法很简单：

FooBar[] fba = something.toArray(FooBar.class);

Collection 接口还没有改变为使用该技术，因为这会破坏许多现有的集合实现。但是如果使用泛型从新构建 Collection，则当然会使用该方言来指定它想要返回值是哪种类型。

 

Enum<E>

JDK 5.0 中 Java 语言另一个增加的特性是枚举。当您使用 enum 关键字声明一个枚举时，编译器就会在内部为您生成一个类，用于扩展 Enum 并为枚举的每个值声明静态实例。所以如果您说：

public enum Suit {HEART, DIAMOND, CLUB, SPADE};

编译器就会在内部生成一个叫做 Suit 的类，该类扩展 java.lang.Enum<Suit> 并具有叫做 HEART、DIAMOND、CLUB 和 SPADE 的常量（public static final）成员，每个成员都是 Suit 类。

与 Class 一样，Enum 也是一个泛型类。但是与 Class 不同，它的签名稍微更复杂一些：

class Enum<E extends Enum<E>> { . . . }

这究竟是什么意思？这难道不会导致无限递归？

我们逐步来分析。类型参数 E 用于 Enum 的各种方法中，比如 compareTo() 或 getDeclaringClass()。为了这些方法的类型安全，Enum 类必须在枚举的类上泛型化。

所以 extends Enum<E> 部分如何理解？该部分又具有两个部分。第一部分指出，作为 Enum 的类型参数的类本身必须是 Enum 的子类型，所以您不能声明一个类 X 扩展 Enum<Integer>。第二部分指出，任何扩展 Enum 的类必须传递它本身 作为类型参数。您不能声明 X 扩展 Enum<Y>，即使 Y 扩展 Enum。

总之，Enum 是一个参数化的类型，只可以为它的子类型实例化，并且这些子类型然后将根据子类型来继承方法。幸运的是，在 Enum 情况下，编译器为您做这些工作，一切都很好。

 

与非泛型代码相互操作

数百万行现有代码使用已经泛型化的 Java 类库中的类，比如集合框架、Class 和 ThreadLocal。JDK 5.0 中的改进不要破坏所有这些代码是很重要的，所以编译器允许您在不指定其类型参数的情况下使用泛型类。

当然，以“旧方式”做事没有新方式安全，因为忽略了编译器准备提供的类型安全。如果您试图将 List<String> 传递给一个接受 List 的方法，它将能够工作，但是编译器将会发出一个可能丧失类型安全的警告，即所谓的“unchecked conversion（不检查转换）”警告。

没有类型参数的泛型，比如声明为 List 类型而不是 List<Something> 类型的变量，叫做原始类型。原始类型与参数化类型的任何实例化是赋值兼容的，但是这样的赋值会生成 unchecked-conversion 警告。

为了消除一些 unchecked-conversion 警告，假设您不准备泛型化所有的代码，您可以使用通配符类型参数。使用 List<?> 而不使用 List。List 是原始类型；List<?> 是具有未知类型参数的泛型。编译器将以不同的方式对待它们，并很可能发出更少的警告。

无论在哪种情况下，编译器在生成字节码时都会生成强制类型转换，所以生成的字节码在每种情况下都不会比没有泛型时更不安全。如果您设法通过使用原始类型或类文件来破坏类型安全，就会得到与不使用泛型时得到的相同的 ClassCastException 或 ArrayStoreException。


已检查集合

作为从原始集合类型迁移到泛型集合类型的帮助，集合框架添加了一些新的集合包装器，以便为一些类型安全 bug 提供早期警告。就像 Collections.unmodifiableSet() 工厂方法用一个不允许任何修改的 Set 包装一个现有 Set 一样，Collections.checkedSet()（以及 checkedList() 和 checkedMap()）工厂方法创建一个包装器（或者视图）类，以防止您将错误类型的变量放在集合中。

checkedXxx() 方法都接受一个类常量作为参数，所以它们可以（在运行时）检查这些修改是允许的。典型的实现可能像下面这样：


public class Collections { 
public static <E> Collection<E> checkedCollection(Collection<E> c, Class<E> type ) { 
    return new CheckedCollection<E>(c, type); 
}

private static class CheckedCollection<E> implements Collection<E> { 
    private final Collection<E> c; 
    private final Class<E> type;

    CheckedCollection(Collection<E> c, Class<E> type) { 
      this.c = c; 
      this.type = type; 
    }

    public boolean add(E o) { 
      if (!type.isInstance(o)) 
        throw new ClassCastException(); 
      else
        return c.add(o); 
    } 
} 
}