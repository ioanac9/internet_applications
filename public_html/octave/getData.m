function getData
import java.sql.DriverManager;
import java.sql.Connection;

connection = DriverManager.getConnection('jdbc:mysql://localhost/ai33','ai33','ai2021');
query = connection.createStatement();

numeroUsuarios = query.executeQuery("SELECT MAX(id) FROM users");
numeroUsuarios.next();

totalUsuarios = numeroUsuarios.getInt(1);
numeroUsuarios.close();

recScore = query.executeQuery("SELECT * FROM user_score");
Y = zeros(1682,totalUsuarios);
  while recScore.next()
    %En las filas tendriamos las peliculas y en las columnas los usuarios
    Y(recScore.getInt(2),recScore.getInt(1)) = recScore.getInt(3);
  end
R = Y;
R(R>0) = 1;


save('matrices.mat','Y','R');
recScore.close();
connection.close();
  
end