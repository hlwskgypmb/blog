<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:7;s:9:"user_name";s:6:"老白";s:5:"title";s:40:"Java 重写(Override)与重载(Overload)";s:4:"cont";s:7437:"[strong]重写(Override)[/strong][br]
重写是子类对父类的允许访问的方法的实现过程进行重新编写, 返回值和形参都不能改变。即外壳不变，核心重写！
重写的好处在于子类可以根据需要，定义特定于自己的行为。 也就是说子类能够根据需要实现父类的方法。
重写方法不能抛出新的检查异常或者比被重写方法申明更加宽泛的异常。例如： 父类的一个方法申明了一个检查异常 IOException，但是在重写这个方法的时候不能抛出 Exception 异常，因为 Exception 是 IOException 的父类，只能抛出 IOException 的子类异常。
在面向对象原则里，重写意味着可以重写任何现有方法。实例如下：
[pre]
class Animal{
   public void move(){
      System.out.println("动物可以移动");
   }
}
 
class Dog extends Animal{
   public void move(){
      System.out.println("狗可以跑和走");
   }
}
 
public class TestDog{
   public static void main(String args[]){
      Animal a = new Animal(); // Animal 对象
      Animal b = new Dog(); // Dog 对象
 
      a.move();// 执行 Animal 类的方法 动物可以移动
 
      b.move();//执行 Dog 类的方法  狗可以跑和走
   }
}
[/pre][hr]
在上面的例子中可以看到，尽管b属于Animal类型，但是它运行的是Dog类的move方法。
这是由于在编译阶段，只是检查参数的引用类型。
然而在运行时，Java虚拟机(JVM)指定对象的类型并且运行该对象的方法。
因此在上面的例子中，之所以能编译成功，是因为Animal类中存在move方法，然而运行时，运行的是特定对象的方法。
思考以下例子：
[pre]
class Animal{
   public void move(){
      System.out.println("动物可以移动");
   }
}
 
class Dog extends Animal{
   public void move(){
      System.out.println("狗可以跑和走");
   }
   public void bark(){
      System.out.println("狗可以吠叫");
   }
}
 
public class TestDog{
   public static void main(String args[]){
      Animal a = new Animal(); // Animal 对象
      Animal b = new Dog(); // Dog 对象
 
      a.move();// 执行 Animal 类的方法 动物可以移动
      b.move();//执行 Dog 类的方法 狗可以跑和走
      b.bark();//抛出异常
 }
}
[/pre]
该程序将抛出一个编译错误，因为b的引用类型Animal没有bark方法。[hr]
[strong]方法的重写规则[/strong][br]
[table][colgroup:1]
[thead]
[tr][th] 规则 [/th][/tr]
[/thead]
[tbody]
[tr][td] 参数列表必须完全与被重写方法的相同；[/td][/tr]
[tr][td] 返回类型必须完全与被重写方法的返回类型相同； [/td][/tr]
[tr][td] 访问权限不能比父类中被重写的方法的访问权限更低。例如：如果父类的一个方法被声明为public，那么在子类中重写该方法就不能声明为protected。[/td][/tr]
[tr][td] 父类的成员方法只能被它的子类重写。[/td][/tr]
[tr][td] 声明为final的方法不能被重写。 [/td][/tr]
[tr][td] 声明为static的方法不能被重写，但是能够被再次声明。 [/td][/tr]
[tr][td] 子类和父类在同一个包中，那么子类可以重写父类所有方法，除了声明为private和final的方法 [/td][/tr]
[tr][td] 子类和父类不在同一个包中，那么子类只能够重写父类的声明为public和protected的非final方法。 [/td][/tr]
[tr][td] 重写的方法能够抛出任何非强制异常，无论被重写的方法是否抛出异常。但是，重写的方法不能抛出新的强制性异常，或者比被重写方法声明的更广泛的强制性异常，反之则可以。[/td][/tr]
[tr][td] 构造方法不能被重写。[/td][/tr]
[tr][td] 如果不能继承一个方法，则不能重写这个方法。 [/td][/tr]
[/tbody]
[/table]
[strong]Super关键字的使用[/strong][br]
当需要在子类中调用父类的被重写方法时，要使用super关键字。
[pre]
class Animal{
   public void move(){
      System.out.println("动物可以移动");
   }
}
 
class Dog extends Animal{
   public void move(){
      super.move(); // 应用super类的方法
      System.out.println("狗可以跑和走");
   }
}
 
public class TestDog{
   public static void main(String args[]){
 
      Animal b = new Dog(); // Dog 对象
      b.move(); //执行 Dog类的方法
 
   }
}
[/pre]
[strong]重载(Overload)[/strong][br]
重载(overloading) 是在一个类里面，方法名字相同，而参数不同。返回类型可以相同也可以不同。
每个重载的方法（或者构造函数）都必须有一个独一无二的参数类型列表。
最常用的地方就是构造器的重载。
[table][colgroup:1]
[thead]
[tr][th] 重载规则 [/th][/tr]
[/thead]
[tbody]
[tr][td] 被重载的方法必须改变参数列表(参数个数或类型不一样)；[/td][/tr]
[tr][td] 被重载的方法可以改变返回类型；[/td][/tr]
[tr][td] 被重载的方法可以改变访问修饰符；[/td][/tr]
[tr][td] 被重载的方法可以声明新的或更广的检查异常；[/td][/tr]
[tr][td] 方法能够在同一个类中或者在一个子类中被重载。[/td][/tr]
[tr][td] 无法以返回值类型作为重载函数的区分标准。[/td][/tr]
[/tbody]
[/table]
[strong]实例[/strong][br]
[pre]
public class Overloading {
    public int test(){
        System.out.println("test1");
        return 1;
    }
 
    public void test(int a){
        System.out.println("test2");
    }   
 
    //以下两个参数类型顺序不同
    public String test(int a,String s){
        System.out.println("test3");
        return "returntest3";
    }   
 
    public String test(String s,int a){
        System.out.println("test4");
        return "returntest4";
    }   
 
    public static void main(String[] args){
        Overloading o = new Overloading();
        System.out.println(o.test());
        o.test(1);
        System.out.println(o.test(1,"test3"));
        System.out.println(o.test("test4",1));
    }
}
[/pre]
[strong]重写与重载之间的区别[/strong][br]
[table][colgroup:3]
[thead]
[tr][th] 区别点 [/th][th] 重载方法 [/th][th] 重写方法[/th][/tr]
[/thead]
[tbody]
[tr][td] 参数列表 [/td][td] 必须修改 [/td][td] 一定不能修改 [/td][/tr]
[tr][td] 返回类型 [/td][td] 可以修改 [/td][td] 一定不能修改 [/td][/tr]
[tr][td] 异常 [/td][td] 可以修改 [/td][td] 可以减少或删除，一定不能抛出新的或者更广的异常 [/td][/tr]
[tr][td] 访问 [/td][td] 可以修改 [/td][td] 一定不能做更严格的限制（可以降低限制）[/td][/tr]
[/tbody]
[/table]
[strong]总结[/strong][br]
方法的重写(Overriding)和重载(Overloading)是java多态性的不同表现，重写是父类与子类之间多态性的一种表现，重载可以理解成多态的具体表现形式。
[table][colgroup:1]
[tbody]
[tr][td] (1)方法重载是一个类中定义了多个方法名相同,而他们的参数的数量不同或数量相同而类型和次序不同,则称为方法的重载(Overloading)。[/td][/tr]
[tr][td] (2)方法重写是在子类存在方法与父类的方法的名字相同,而且参数的个数与类型一样,返回值也一样的方法,就称为重写(Overriding)。[/td][/tr]
[tr][td] (3)方法重载是一个类的多态性表现,而方法重写是子类与父类的一种多态性表现。[/td][/tr]
[/tbody]
[/table]
img[/static/file/20180911/af87979c901160fd003ec1833b146884.jpg] 
";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:7;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-09-11 14:39:26";s:7:"type_id";i:2;s:4:"type";s:4:"JAVA";}