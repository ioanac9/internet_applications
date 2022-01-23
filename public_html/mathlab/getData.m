function getData
import java.sql.DriverManager;
import java.sql.Connection;

connection = DriverManager.getConnection('jdbc:mysql://localhost/Asd','localhost','Rodeapps123');
query = connection.createStatement();

numberOfUsers = query.executeQuery("SELECT MAX(id) FROM users");
numberOfUsers.next();

connection.close();
end
