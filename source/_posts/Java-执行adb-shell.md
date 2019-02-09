title: Java 执行adb shell
categories: 
tags: []
date: 2015-06-24 08:37:00
---
    import java.io.BufferedReader;
    import java.io.BufferedWriter;
    import java.io.IOException;
    import java.io.InputStreamReader;
    import java.io.OutputStreamWriter;
    
    public class AdbShell {
    	public static void main(String[] args) {
    		// C:\\Users\\Administrator\\Desktop\\adbProduct\\adb.exe shell
    
    		try {
    
    			Process process = Runtime
    					.getRuntime()
    					.exec("C:\\Users\\Administrator\\Desktop\\adbProduct\\adb.exe shell"); // adb
    			// shell
    
    			final BufferedWriter outputStream = new BufferedWriter(
    					new OutputStreamWriter(process.getOutputStream()));
    
    			final BufferedReader inputStream = new BufferedReader(
    					new InputStreamReader(process.getInputStream()));
    
    			// 这里一定要注意错误流的读取，不然很容易阻塞，得不到你想要的结果，
    
    			final BufferedReader errorReader = new BufferedReader(
    					new InputStreamReader(process.getErrorStream()));
    
    			new Thread(new Runnable() {
    
    				String line;
    
    				public void run() {
    
    					System.out.println("listener started");
    
    					try {
    
    						while ((line = inputStream.readLine()) != null) {
    							System.out.println(inputStream.readLine());
    							System.out.println(line);
    						}
    					} catch (IOException e) {
    
    						// e.printStackTrace();
    
    					}
    
    				}
    
    			}).start();
    
    			new Thread(new Runnable() {
    				final BufferedReader br = new BufferedReader(
    						new InputStreamReader(System.in));
    
    				public void run() {
    					System.out.println("writer started");
    
    					String line;
    
    					try {
    
    						while ((line = br.readLine()) != null) {
    
    							outputStream.write(line + "\r\n");
    
    							outputStream.flush();
    
    						}
    
    					} catch (IOException e) {
    
    						// e.printStackTrace();
    
    					}
    
    				}
    
    			}).start();
    
    			int i = process.waitFor();
    
    			System.out.println("i=" + i);
    
    		} catch (Exception e) {
    
    			e.printStackTrace();
    
    		}
    
    	}
    }

