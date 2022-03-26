#include<stdio.h>
#include<time.h>
#include<stdlib.h>
#define MAX 100000
int arr[MAX];
void selectionSort(int n)
{
	int j,i,imin,temp;
	for(i=0;i<n;i++)
	{
		imin=i;
		for(j=i+1;j<n;j++)
		{
			if(arr[imin]>arr[j])
			{
				imin=j;
			}
		}
		temp=arr[imin];
		arr[imin]=arr[i];
		arr[i]=temp;
	}
}
int main()
{
	int n,i;
	n=MAX;
	printf("time:%ld\n",time(NULL));
//	printf("Number of elements:\n");
//	scanf("%d",&n);
	for(i=0;i<n;i++)
	{
		//scanf("%d",&arr[i]);
		arr[i]=rand();
	}
	selectionSort(n);
	for(i=0;i<n;i++)
	{
//		printf("%d\t",arr[i]);
	}
	printf("time:%ld\n",time(NULL));
	return 0;
}
