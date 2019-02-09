title: Java 使用反射 实例化 构造器带有数组参数的类
categories: 旧文字
tags: [java]
date: 2015-08-16 14:38:24
---
    public class MyLoader extends URLClassLoader{
    public static void main(String[] args) throws Exception {
        String path = "file:/Users/zhoukai/Documents/Test.jar";
        while (true) {
            Constructor st =Class.forName("com.test.MyLoader").getConstructor(URL[].class);
            ClassLoader loader = (ClassLoader) st.newInstance(new Object[]{new URL[]{new URL(path)}});
            Class cl = loader.loadClass("com.bean.Test");
            Object ob = cl.newInstance();
            cl.getMethod("say").invoke(ob);
            Thread.sleep(1000);
        }
    }
    /**
     * @param urls
     */
    public MyLoader(URL[] urls) {
        super(urls);
        // TODO Auto-generated constructor stub
    }
}