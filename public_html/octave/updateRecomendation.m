function updateRecomendation(idUser)
  
%  Cargamos datos
fprintf('Generando puntuaciones\n');
getData();
fprintf('Cargando puntuaciones\n');
load('matrices.mat');

num_users = size(Y, 2);
num_movies = size(Y, 1);
num_features = 10;

X = randn(num_movies, num_features);
Theta = randn(num_users, num_features);

initial_parameters = [X(:); Theta(:)];

options = optimset('GradObj', 'on', 'MaxIter', 100);

lambda = 10;
theta = fmincg (@(t)(cofiCostFunc(t, Y, R, num_users, num_movies, ...
                                num_features, lambda)), ...
                initial_parameters, options);
                
X = reshape(theta(1:num_movies*num_features), num_movies, num_features);
Theta = reshape(theta(num_movies*num_features+1:end), ...
                num_users, num_features);
                

p = X * Theta';
my_predictions = p(:,idUser).*(ones(num_movies,1) - R(:,idUser));

import java.sql.DriverManager;
import java.sql.Connection;
connection = DriverManager.getConnection('jdbc:mysql://localhost/ai33','ai33','ai2021');
query = connection.createStatement();

query.executeUpdate(strcat("DELETE FROM recs WHERE user_id = '",num2str(idUser),"';"));

[r,ix] = sort(my_predictions, 'descend');
for i=1:10
    j = ix(i);
    query.executeUpdate(strcat('INSERT INTO recs (user_id,movie_id,rec_score) VALUES (''',num2str(idUser),''',''',num2str(j),''',''',num2str(my_predictions(j)),''')'));
end
connection.close();
end
